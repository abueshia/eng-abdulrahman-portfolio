<?php

/**
 * TestimonialController
 *
 * Thin Admin Controller for managing client testimonials and ratings.
 * Delegates all business logic, media uploads, and cache invalidation to TestimonialService.
 */

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Testimonial\StoreTestimonialRequest;
use App\Http\Requests\Admin\Testimonial\UpdateTestimonialRequest;
use App\Models\Testimonial;
use App\Services\TestimonialService;
use App\ViewModels\TestimonialViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class TestimonialController extends Controller
{
    public function __construct(
        private readonly TestimonialService $testimonialService,
    ) {
        $this->middleware(['auth:admin', 'permission:testimonial.view_all'], ['only' => ['index', 'table']]);
        $this->middleware(['auth:admin', 'permission:testimonial.view_details'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:testimonial.create'], ['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:testimonial.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:testimonial.delete'], ['only' => ['destroy']]);
        $this->middleware(['auth:admin', 'permission:testimonial.sort'], ['only' => ['reorder', 'saveReorder']]);
    }

    /**
     * Display the testimonials listing page.
     */
    public function index(): View
    {
        $this->authorize('viewAny', Testimonial::class);

        $total_reviews = $this->testimonialService->countActive();
        $average_rating = $this->testimonialService->averageRating();

        return view('admin.pages.testimonial.index', compact('total_reviews', 'average_rating'));
    }

    /**
     * Return Yajra DataTables JSON payload for the testimonials table.
     */
    public function table(DataTables $dataTables, Request $request): JsonResponse
    {
        $this->authorize('viewAny', Testimonial::class);

        $query = $this->testimonialService->getAdminDataTableQuery();

        if ($request->filled('search.value')) {
            $search = (string) $request->input('search.value');
            $query->where(static function ($builder) use ($search): void {
                $builder->where('name->ar', 'like', "%{$search}%")
                    ->orWhere('name->en', 'like', "%{$search}%")
                    ->orWhere('company_name->ar', 'like', "%{$search}%")
                    ->orWhere('company_name->en', 'like', "%{$search}%");
            });
        }

        return $dataTables->eloquent($query)
            ->addIndexColumn()
            ->editColumn('name', static fn (Testimonial $testimonial): string => e((string) $testimonial->name))
            ->addColumn('project', static fn (Testimonial $testimonial): string => e((string) ($testimonial->project?->title ?? '-')))
            ->editColumn('description', static fn (Testimonial $testimonial): string => e(Str::limit((string) $testimonial->description, 60)))
            ->editColumn('rating', static function (Testimonial $testimonial): string {
                $stars = '';
                $count = max(1, min(5, (int) $testimonial->rating));
                for ($i = 0; $i < $count; $i++) {
                    $stars .= '<i class="fa-solid fa-star text-warning"></i>';
                }

                return $stars;
            })
            ->editColumn('is_active', static fn (Testimonial $testimonial): string => $testimonial->is_active
                ? '<span class="badge badge-light-success">'.e(TranslationHelper::translate('Active')).'</span>'
                : '<span class="badge badge-light-danger">'.e(TranslationHelper::translate('Inactive')).'</span>')
            ->editColumn('created_at', static fn (Testimonial $testimonial): string => $testimonial->created_at?->format('Y-m-d') ?? '-')
            ->addColumn('action', static fn (Testimonial $testimonial): string => view('admin.pages.testimonial.buttons', compact('testimonial'))->render())
            ->rawColumns(['rating', 'is_active', 'action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new testimonial.
     */
    public function create(): View
    {
        $this->authorize('create', Testimonial::class);

        return view('admin.pages.testimonial.form', new TestimonialViewModel);
    }

    /**
     * Store a newly created testimonial in storage.
     */
    public function store(StoreTestimonialRequest $request): RedirectResponse
    {
        $this->authorize('create', Testimonial::class);

        $this->testimonialService->create($request->validated(), $request->file('image'));

        session()->flash('success', TranslationHelper::translate('Operation Success'));

        return redirect()->route('admin.testimonial.index');
    }

    /**
     * Display the specified testimonial details.
     */
    public function show(Testimonial $testimonial): View
    {
        $this->authorize('view', $testimonial);
        $testimonial->load(['project', 'media']);

        return view('admin.pages.testimonial.show', compact('testimonial'));
    }

    /**
     * Show the form for editing the specified testimonial.
     */
    public function edit(Testimonial $testimonial): View
    {
        $this->authorize('update', $testimonial);
        $testimonial->load(['project', 'media']);

        return view('admin.pages.testimonial.form', new TestimonialViewModel($testimonial));
    }

    /**
     * Update the specified testimonial in storage.
     */
    public function update(UpdateTestimonialRequest $request, Testimonial $testimonial): RedirectResponse
    {
        $this->authorize('update', $testimonial);

        $this->testimonialService->update($testimonial, $request->validated(), $request->file('image'));

        session()->flash('success', TranslationHelper::translate('Successfully Updated'));

        return redirect()->route('admin.testimonial.index');
    }

    /**
     * Remove the specified testimonial from storage.
     */
    public function destroy(Testimonial $testimonial): JsonResponse
    {
        $this->authorize('delete', $testimonial);

        $this->testimonialService->delete($testimonial);

        return response()->json([
            'status' => 'success',
            'message' => TranslationHelper::translate('Successfully Deleted'),
        ]);
    }

    /**
     * Display the drag-and-drop reorder page for testimonials.
     */
    public function reorder(): View
    {
        $this->authorize('reorder', Testimonial::class);

        $items = $this->testimonialService->getAllForReorder();

        return view('admin.pages.testimonial.reorder', compact('items'));
    }

    /**
     * Persist the new sort order of testimonials.
     */
    public function saveReorder(Request $request): JsonResponse
    {
        $this->authorize('reorder', Testimonial::class);

        $items = (array) ($request->input('items') ?? $request->input('tree') ?? []);
        $this->testimonialService->reorder($items);

        return response()->json([
            'status' => 'success',
            'message' => TranslationHelper::translate('Done, Sorting Has Been Saved'),
        ]);
    }
}
