<?php

/**
 * API BlogController
 *
 * Read-only REST API controller for technical blog articles and categories.
 * Supports category filtering, pagination, and slug-based detail retrieval.
 */

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserApp\BlogResource;
use App\Http\Resources\UserApp\CategoryResource;
use App\Http\Resources\UserApp\PaginationCollection;
use App\Services\BlogService;
use App\Services\CategoryService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    use ApiResponseTrait;

    public function __construct(
        private readonly BlogService $blogService,
        private readonly CategoryService $categoryService,
    ) {}

    /**
     * List published technical blog articles with optional category filter and pagination.
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = min(max((int) ($request->query('per_page') ?? $request->query('limit') ?? 9), 1), 50);
        $filters = $request->only(['category', 'category_id', 'featured']);

        $paginator = $this->blogService->paginatePublished($perPage, $filters);
        $data = BlogResource::collection($paginator);
        $pagination = new PaginationCollection($paginator);

        return $this->success_response_with_pagination(
            $data,
            'Blogs retrieved successfully',
            $pagination
        );
    }

    /**
     * List active categories with published project and blog counts.
     */
    public function categories(): JsonResponse
    {
        $categories = $this->categoryService->getActiveWithCounts();

        return $this->success_response(
            CategoryResource::collection($categories),
            'Categories retrieved successfully'
        );
    }

    /**
     * Show a single published blog article by its unique slug along with related articles.
     */
    public function show(Request $request, string $slug): JsonResponse
    {
        $blog = $this->blogService->findBySlug($slug, true);

        if ($blog === null) {
            return $this->error_response('Blog article not found', 404);
        }

        $this->blogService->incrementViews($blog);

        $related = $this->blogService->getRelated($blog, 3);
        $payload = (new BlogResource($blog))->resolve($request);
        $payload['related_blogs'] = BlogResource::collection($related)->resolve($request);

        return $this->success_response($payload, 'Blog details retrieved successfully');
    }
}

