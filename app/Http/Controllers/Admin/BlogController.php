<?php

/**
 * BlogController
 *
 * Thin Admin Controller for managing bilingual technical articles and tutorials.
 * Delegates all business logic, media uploads, and cache invalidation to BlogService.
 */

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Enums\BlogStatusEnum;
use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Blog\StoreBlogRequest;
use App\Http\Requests\Admin\Blog\UpdateBlogRequest;
use App\Models\Blog;
use App\Services\BlogService;
use App\ViewModels\BlogViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class BlogController extends Controller
{
    public function __construct(
        private readonly BlogService $blogService,
    ) {
        $this->middleware(['auth:admin', 'permission:blogs.view_all'], ['only' => ['index', 'table']]);
        $this->middleware(['auth:admin', 'permission:blogs.view_details'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:blogs.create'], ['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:blogs.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:blogs.delete'], ['only' => ['destroy']]);
        $this->middleware(['auth:admin', 'permission:blogs.sort'], ['only' => ['reorder', 'saveReorder']]);
    }

    /**
     * Display the blogs listing page.
     */
    public function index(): View
    {
        $this->authorize('viewAny', Blog::class);

        return view('admin.pages.blog.index');
    }

    /**
     * Return Yajra DataTables JSON payload for the blogs table.
     */
    public function table(DataTables $dataTables, Request $request): JsonResponse
    {
        $this->authorize('viewAny', Blog::class);

        $query = $this->blogService->getAdminDataTableQuery();

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
            ->editColumn('image', static function (Blog $blog): string {
                $imageUrl = $blog->getFirstMediaUrl('blogs')
                    ?: ($blog->getFirstMediaUrl('blogs_image') ?: asset('dashboard/assets/media/avatars/blank.png'));

                return '<img width="65" height="45" style="object-fit:cover;border-radius:6px;" src="'.e($imageUrl).'" alt="'.e((string) $blog->name).'"/>';
            })
            ->editColumn('name', static fn (Blog $blog): string => e((string) $blog->name))
            ->addColumn('category', static fn (Blog $blog): string => e((string) ($blog->category?->name ?? '-')))
            ->editColumn('status', static function (Blog $blog): string {
                $status = $blog->status instanceof BlogStatusEnum
                    ? $blog->status
                    : BlogStatusEnum::tryFrom((string) $blog->status);

                if ($status === null) {
                    return '-';
                }

                return '<span class="badge badge-light-'.$status->color().'">'.e($status->label()).'</span>';
            })
            ->editColumn('published_at', static fn (Blog $blog): string => $blog->published_at?->format('Y-m-d') ?? '-')
            ->editColumn('created_at', static fn (Blog $blog): string => $blog->created_at?->format('Y-m-d') ?? '-')
            ->addColumn('action', static fn (Blog $blog): string => view('admin.pages.blog.buttons', compact('blog'))->render())
            ->rawColumns(['image', 'status', 'action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new blog article.
     */
    public function create(): View
    {
        $this->authorize('create', Blog::class);

        return view('admin.pages.blog.form', new BlogViewModel);
    }

    /**
     * Store a newly created blog article in storage.
     */
    public function store(StoreBlogRequest $request): RedirectResponse
    {
        $this->authorize('create', Blog::class);

        $this->blogService->create($request->validated(), $request->file('image'));

        session()->flash('success', TranslationHelper::translate('Operation Success'));

        return redirect()->route('admin.blog.index');
    }

    /**
     * Display the specified blog article details.
     */
    public function show(Blog $blog): View
    {
        $this->authorize('view', $blog);
        $blog->load(['category', 'media']);

        return view('admin.pages.blog.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified blog article.
     */
    public function edit(Blog $blog): View
    {
        $this->authorize('update', $blog);
        $blog->load(['category', 'media']);

        return view('admin.pages.blog.form', new BlogViewModel($blog));
    }

    /**
     * Update the specified blog article in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog): RedirectResponse
    {
        $this->authorize('update', $blog);

        $this->blogService->update($blog, $request->validated(), $request->file('image'));

        session()->flash('success', TranslationHelper::translate('Successfully Updated'));

        return redirect()->route('admin.blog.index');
    }

    /**
     * Remove the specified blog article from storage.
     */
    public function destroy(Blog $blog): JsonResponse
    {
        $this->authorize('delete', $blog);

        $this->blogService->delete($blog);

        return response()->json([
            'status' => 'success',
            'message' => TranslationHelper::translate('Successfully Deleted'),
        ]);
    }

    /**
     * Display the drag-and-drop reorder page for blog articles.
     */
    public function reorder(): View
    {
        $this->authorize('reorder', Blog::class);

        $items = $this->blogService->getAllForReorder();

        return view('admin.pages.blog.reorder', compact('items'));
    }

    /**
     * Persist the new sort order of blog articles.
     */
    public function saveReorder(Request $request): JsonResponse
    {
        $this->authorize('reorder', Blog::class);

        $items = (array) ($request->input('items') ?? $request->input('tree') ?? []);
        $this->blogService->reorder($items);

        return response()->json([
            'status' => 'success',
            'message' => TranslationHelper::translate('Done, Sorting Has Been Saved'),
        ]);
    }
}
