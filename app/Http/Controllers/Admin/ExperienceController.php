<?php

/**
 * ExperienceController
 *
 * Thin Admin Controller for managing professional career timeline entries.
 * Delegates all business logic, technology pivot sync, media uploads,
 * and cache invalidation to ExperienceService.
 */

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Enums\EmploymentTypeEnum;
use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Experience\StoreExperienceRequest;
use App\Http\Requests\Admin\Experience\UpdateExperienceRequest;
use App\Models\Experience;
use App\Services\ExperienceService;
use App\ViewModels\ExperienceViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class ExperienceController extends Controller
{
    public function __construct(
        private readonly ExperienceService $experienceService,
    ) {
        $this->middleware(['auth:admin', 'permission:experiences.view_all'], ['only' => ['index', 'table']]);
        $this->middleware(['auth:admin', 'permission:experiences.view_details'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:experiences.create'], ['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:experiences.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:experiences.delete'], ['only' => ['destroy']]);
        $this->middleware(['auth:admin', 'permission:experiences.sort'], ['only' => ['reorder', 'saveReorder']]);
    }

    /**
     * Display the experiences listing page.
     */
    public function index(): View
    {
        return view('admin.pages.experience.index');
    }

    /**
     * Return Yajra DataTables JSON payload for the experiences table.
     */
    public function table(DataTables $dataTables, Request $request): JsonResponse
    {
        $query = $this->experienceService->getAdminDataTableQuery();

        if ($request->filled('search.value')) {
            $search = (string) $request->input('search.value');
            $query->where(static function ($builder) use ($search): void {
                $builder->where('company_name->ar', 'like', "%{$search}%")
                    ->orWhere('company_name->en', 'like', "%{$search}%")
                    ->orWhere('role_title->ar', 'like', "%{$search}%")
                    ->orWhere('role_title->en', 'like', "%{$search}%");
            });
        }

        return $dataTables->eloquent($query)
            ->addIndexColumn()
            ->editColumn('company_name', static fn (Experience $experience): string => e((string) $experience->company_name))
            ->editColumn('role_title', static fn (Experience $experience): string => e((string) $experience->role_title))
            ->editColumn('employment_type', static function (Experience $experience): string {
                $type = $experience->employment_type instanceof EmploymentTypeEnum
                    ? $experience->employment_type
                    : EmploymentTypeEnum::tryFrom((string) $experience->employment_type);

                if ($type === null) {
                    return '-';
                }

                return '<span class="badge badge-light-'.$type->color().'">'.e($type->label()).'</span>';
            })
            ->addColumn('period', static function (Experience $experience): string {
                $start = $experience->start_date?->format('Y-m') ?? '-';
                $end = $experience->is_current
                    ? TranslationHelper::translate('Present')
                    : ($experience->end_date?->format('Y-m') ?? '-');

                return e("{$start} -> {$end}");
            })
            ->editColumn('is_active', static fn (Experience $experience): string => $experience->is_active
                ? '<span class="badge badge-light-success">'.e(TranslationHelper::translate('Active')).'</span>'
                : '<span class="badge badge-light-danger">'.e(TranslationHelper::translate('Inactive')).'</span>')
            ->addColumn('action', static fn (Experience $experience): string => view('admin.pages.experience.buttons', compact('experience'))->render())
            ->rawColumns(['employment_type', 'is_active', 'action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new experience entry.
     */
    public function create(): View
    {
        return view('admin.pages.experience.form', new ExperienceViewModel);
    }

    /**
     * Store a newly created experience entry in storage.
     */
    public function store(StoreExperienceRequest $request): RedirectResponse
    {
        $this->experienceService->create($request->validated(), $request->file('image'));

        session()->flash('success', TranslationHelper::translate('Operation Success'));

        return redirect()->route('admin.experience.index');
    }

    /**
     * Display the specified experience entry details.
     */
    public function show(Experience $experience): View
    {
        $experience->load(['technologies', 'media']);

        return view('admin.pages.experience.show', compact('experience'));
    }

    /**
     * Show the form for editing the specified experience entry.
     */
    public function edit(Experience $experience): View
    {
        $experience->load(['technologies', 'media']);

        return view('admin.pages.experience.form', new ExperienceViewModel($experience));
    }

    /**
     * Update the specified experience entry in storage.
     */
    public function update(UpdateExperienceRequest $request, Experience $experience): RedirectResponse
    {
        $this->experienceService->update($experience, $request->validated(), $request->file('image'));

        session()->flash('success', TranslationHelper::translate('Successfully Updated'));

        return redirect()->route('admin.experience.index');
    }

    /**
     * Remove the specified experience entry from storage.
     */
    public function destroy(Experience $experience): JsonResponse
    {
        $this->experienceService->delete($experience);

        return response()->json([
            'status' => 'success',
            'message' => TranslationHelper::translate('Successfully Deleted'),
        ]);
    }

    /**
     * Display the drag-and-drop reorder page for experiences.
     */
    public function reorder(): View
    {
        $items = $this->experienceService->getAllForReorder();

        return view('admin.pages.experience.reorder', compact('items'));
    }

    /**
     * Persist the new sort order of experiences.
     */
    public function saveReorder(Request $request): JsonResponse
    {
        $items = (array) ($request->input('items') ?? $request->input('tree') ?? []);
        $this->experienceService->reorder($items);

        return response()->json([
            'status' => 'success',
            'message' => TranslationHelper::translate('Done, Sorting Has Been Saved'),
        ]);
    }
}

