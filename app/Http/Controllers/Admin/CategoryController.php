<?php

/**
 * CategoryController
 *
 * Thin Admin Controller for managing bilingual project and article categories.
 * Delegates all business logic, media uploads, and cache invalidation to CategoryService.
 */

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use App\ViewModels\CategoryViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    public function __construct(
        private readonly CategoryService $categoryService,
    ) {
        $this->middleware(['auth:admin', 'permission:categories.view_all'], ['only' => ['index', 'table']]);
        $this->middleware(['auth:admin', 'permission:categories.view_details'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:categories.create'], ['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:categories.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:categories.delete'], ['only' => ['destroy']]);
        $this->middleware(['auth:admin', 'permission:categories.sort'], ['only' => ['reorder', 'saveReorder']]);
    }

    /**
     * Display the categories listing page.
     */
    public function index(): View
    {
        $this->authorize('viewAny', Category::class);

        return view('admin.pages.category.index');
    }

    /**
     * Return Yajra DataTables JSON payload for the categories table.
     */
    public function table(DataTables $dataTables, Request $request): JsonResponse
    {
        $this->authorize('viewAny', Category::class);

        $query = $this->categoryService->getAdminDataTableQuery();

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
            ->editColumn('name', static fn (Category $category): string => e((string) $category->name))
            ->editColumn('slug', static fn (Category $category): string => e((string) $category->slug))
            ->addColumn('projects_count', static fn (Category $category): int => (int) ($category->projects_count ?? 0))
            ->addColumn('blogs_count', static fn (Category $category): int => (int) ($category->blogs_count ?? 0))
            ->editColumn('is_active', static fn (Category $category): string => $category->is_active
                ? '<span class="badge badge-light-success">'.e(TranslationHelper::translate('Active')).'</span>'
                : '<span class="badge badge-light-danger">'.e(TranslationHelper::translate('Inactive')).'</span>')
            ->addColumn('action', static fn (Category $category): string => view('admin.pages.category.buttons', compact('category'))->render())
            ->rawColumns(['is_active', 'action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new category.
     */
    public function create(): View
    {
        $this->authorize('create', Category::class);

        return view('admin.pages.category.form', new CategoryViewModel);
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $this->authorize('create', Category::class);

        $this->categoryService->create($request->validated(), $request->file('image'));

        session()->flash('success', TranslationHelper::translate('Operation Success'));

        return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified category details.
     */
    public function show(Category $category): View
    {
        $this->authorize('view', $category);
        $category->load(['projects', 'blogs', 'media']);

        return view('admin.pages.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(Category $category): View
    {
        $this->authorize('update', $category);
        $category->load('media');

        return view('admin.pages.category.form', new CategoryViewModel($category));
    }

    /**
     * Update the specified category in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $this->authorize('update', $category);

        $this->categoryService->update($category, $request->validated(), $request->file('image'));

        session()->flash('success', TranslationHelper::translate('Successfully Updated'));

        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(Category $category): JsonResponse
    {
        $this->authorize('delete', $category);

        $this->categoryService->delete($category);

        return response()->json([
            'status' => 'success',
            'message' => TranslationHelper::translate('Successfully Deleted'),
        ]);
    }

    /**
     * Display the drag-and-drop reorder page for categories.
     */
    public function reorder(): View
    {
        $this->authorize('reorder', Category::class);

        $items = $this->categoryService->getAllForReorder();

        return view('admin.pages.category.reorder', compact('items'));
    }

    /**
     * Persist the new sort order of categories.
     */
    public function saveReorder(Request $request): JsonResponse
    {
        $this->authorize('reorder', Category::class);

        $items = (array) ($request->input('items') ?? $request->input('tree') ?? []);
        $this->categoryService->reorder($items);

        return response()->json([
            'status' => 'success',
            'message' => TranslationHelper::translate('Done, Sorting Has Been Saved'),
        ]);
    }
}
