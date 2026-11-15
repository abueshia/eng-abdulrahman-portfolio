<?php

/**
 * TechnologyController
 *
 * Thin Admin Controller for managing programming languages, frameworks, and tools.
 * Delegates all business logic, media uploads, and cache invalidation to TechnologyService.
 */

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Enums\TechnologyCategoryEnum;
use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Technology\StoreTechnologyRequest;
use App\Http\Requests\Admin\Technology\UpdateTechnologyRequest;
use App\Models\Technology;
use App\Services\TechnologyService;
use App\ViewModels\TechnologyViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class TechnologyController extends Controller
{
    public function __construct(
        private readonly TechnologyService $technologyService,
    ) {
        $this->middleware(['auth:admin', 'permission:technologies.view_all'], ['only' => ['index', 'table']]);
        $this->middleware(['auth:admin', 'permission:technologies.view_details'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:technologies.create'], ['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:technologies.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:technologies.delete'], ['only' => ['destroy']]);
        $this->middleware(['auth:admin', 'permission:technologies.sort'], ['only' => ['reorder', 'saveReorder']]);
    }

    /**
     * Display the technologies listing page.
     */
    public function index(): View
    {
        return view('admin.pages.technology.index');
    }

    /**
     * Return Yajra DataTables JSON payload for the technologies table.
     */
    public function table(DataTables $dataTables, Request $request): JsonResponse
    {
        $query = $this->technologyService->getAdminDataTableQuery();

        if ($request->filled('search.value')) {
            $search = (string) $request->input('search.value');
            $query->where(static function ($builder) use ($search): void {
                $builder->where('name->ar', 'like', "%{$search}%")
                    ->orWhere('name->en', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        return $dataTables->eloquent($query)
            ->addIndexColumn()
            ->editColumn('image', static function (Technology $technology): string {
                $imageUrl = $technology->getFirstMediaUrl('technologies');
                if ($imageUrl !== '') {
                    return '<img width="42" height="42" style="object-fit:contain;border-radius:6px;" src="'.e($imageUrl).'" alt="'.e((string) $technology->name).'"/>';
                }

                if (! empty($technology->icon)) {
                    return '<i class="'.e((string) $technology->icon).' fs-2 text-primary"></i>';
                }

                return '-';
            })
            ->editColumn('name', static fn (Technology $technology): string => e((string) $technology->name))
            ->editColumn('category', static function (Technology $technology): string {
                $category = $technology->category instanceof TechnologyCategoryEnum
                    ? $technology->category
                    : TechnologyCategoryEnum::tryFrom((string) $technology->category);

                if ($category === null) {
                    return '-';
                }

                return '<span class="badge badge-light-'.$category->color().'">'.e($category->label()).'</span>';
            })
            ->editColumn('proficiency_percent', static fn (Technology $technology): string => ((int) $technology->proficiency_percent).'%')
            ->editColumn('years_of_experience', static fn (Technology $technology): string => number_format((float) $technology->years_of_experience, 1))
            ->editColumn('is_featured', static fn (Technology $technology): string => $technology->is_featured
                ? '<span class="badge badge-light-warning">'.e(TranslationHelper::translate('Featured')).'</span>'
                : '<span class="badge badge-light">'.e(TranslationHelper::translate('Standard')).'</span>')
            ->addColumn('action', static fn (Technology $technology): string => view('admin.pages.technology.buttons', compact('technology'))->render())
            ->rawColumns(['image', 'category', 'is_featured', 'action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new technology.
     */
    public function create(): View
    {
        return view('admin.pages.technology.form', new TechnologyViewModel);
    }

    /**
     * Store a newly created technology in storage.
     */
    public function store(StoreTechnologyRequest $request): RedirectResponse
    {
        $this->technologyService->create($request->validated(), $request->file('image'));

        session()->flash('success', TranslationHelper::translate('Operation Success'));

        return redirect()->route('admin.technology.index');
    }

    /**
     * Display the specified technology details.
     */
    public function show(Technology $technology): View
    {
        $technology->load(['projects', 'experiences', 'media']);

        return view('admin.pages.technology.show', compact('technology'));
    }

    /**
     * Show the form for editing the specified technology.
     */
    public function edit(Technology $technology): View
    {
        return view('admin.pages.technology.form', new TechnologyViewModel($technology));
    }

    /**
     * Update the specified technology in storage.
     */
    public function update(UpdateTechnologyRequest $request, Technology $technology): RedirectResponse
    {
        $this->technologyService->update($technology, $request->validated(), $request->file('image'));

        session()->flash('success', TranslationHelper::translate('Successfully Updated'));

        return redirect()->route('admin.technology.index');
    }

    /**
     * Remove the specified technology from storage.
     */
    public function destroy(Technology $technology): JsonResponse
    {
        $this->technologyService->delete($technology);

        return response()->json([
            'status' => 'success',
            'message' => TranslationHelper::translate('Successfully Deleted'),
        ]);
    }

    /**
     * Display the drag-and-drop reorder page for technologies.
     */
    public function reorder(): View
    {
        $items = $this->technologyService->getAllForReorder();

        return view('admin.pages.technology.reorder', compact('items'));
    }

    /**
     * Persist the new sort order of technologies.
     */
    public function saveReorder(Request $request): JsonResponse
    {
        $items = (array) ($request->input('items') ?? $request->input('tree') ?? []);
        $this->technologyService->reorder($items);

        return response()->json([
            'status' => 'success',
            'message' => TranslationHelper::translate('Done, Sorting Has Been Saved'),
        ]);
    }
}

