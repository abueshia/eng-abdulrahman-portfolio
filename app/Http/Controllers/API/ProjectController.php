<?php

/**
 * API ProjectController
 *
 * Read-only REST API controller for portfolio projects and case studies.
 * Supports filtering by project type, category, and technology, with pagination
 * and slug-based detail retrieval.
 */

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserApp\PaginationCollection;
use App\Http\Resources\UserApp\ProjectResource;
use App\Services\ProjectService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    use ApiResponseTrait;

    public function __construct(
        private readonly ProjectService $projectService,
    ) {}

    /**
     * List published portfolio projects with optional filters and pagination.
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = min(max((int) ($request->query('per_page') ?? $request->query('limit') ?? 9), 1), 50);
        $filters = $request->only(['type', 'category', 'category_id', 'technology', 'technology_id', 'featured']);

        $paginator = $this->projectService->paginatePublished($perPage, $filters);
        $data = ProjectResource::collection($paginator);
        $pagination = new PaginationCollection($paginator);

        return $this->success_response_with_pagination(
            $data,
            'Projects retrieved successfully',
            $pagination
        );
    }

    /**
     * Show a single published project by its unique slug along with related projects.
     */
    public function show(Request $request, string $slug): JsonResponse
    {
        $project = $this->projectService->findBySlug($slug, true);

        if ($project === null) {
            return $this->error_response('Project not found', 404);
        }

        $related = $this->projectService->getRelated($project, 3);
        $payload = (new ProjectResource($project))->resolve($request);
        $payload['related_projects'] = ProjectResource::collection($related)->resolve($request);

        return $this->success_response($payload, 'Project details retrieved successfully');
    }
}

