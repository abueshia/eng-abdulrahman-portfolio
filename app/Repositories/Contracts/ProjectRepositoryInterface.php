<?php

/**
 * ProjectRepositoryInterface
 *
 * Contract for reading and persisting portfolio projects / case studies. Every read
 * method eager loads the relations it needs to prevent N+1 queries.
 */

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Enums\ProjectTypeEnum;
use App\Models\Project;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface ProjectRepositoryInterface extends SluggableRepositoryInterface
{
    /**
     * Get all published and active projects (category, technologies and media eager loaded).
     *
     * @return Collection<int, Project>
     */
    public function getPublished(): Collection;

    /**
     * Get the featured published projects.
     *
     * @return Collection<int, Project>
     */
    public function getFeatured(int $limit = 6): Collection;

    /**
     * Get the published projects of a specific type.
     *
     * @return Collection<int, Project>
     */
    public function getByType(ProjectTypeEnum $type): Collection;

    /**
     * Get the published projects assigned to a category.
     *
     * @return Collection<int, Project>
     */
    public function getByCategory(int $categoryId): Collection;

    /**
     * Paginate published projects for the public portfolio with optional filters.
     *
     * @return LengthAwarePaginator<Project>
     */
    public function paginatePublished(
        int $perPage = 9,
        ?ProjectTypeEnum $type = null,
        ?int $categoryId = null
    ): LengthAwarePaginator;

    /**
     * Find a project by slug with category, technologies, gallery media and approved testimonials.
     *
     * @throws ModelNotFoundException
     */
    public function findBySlugWithRelations(string $slug, bool $onlyPublished = true): Project;

    /**
     * Get published projects related to the given one (same category or sharing technologies).
     *
     * @return Collection<int, Project>
     */
    public function getRelated(Project $project, int $limit = 3): Collection;

    /**
     * Paginate projects for the admin dashboard with optional search/status/type filters.
     *
     * @param  array{search?: string|null, status?: string|null, type?: string|null}  $filters
     * @return LengthAwarePaginator<Project>
     */
    public function paginateForAdmin(int $perPage = 15, array $filters = []): LengthAwarePaginator;

    /**
     * Get the latest projects for the admin dashboard with relations eager loaded.
     *
     * @return Collection<int, Project>
     */
    public function getLatestForAdmin(int $limit = 5): Collection;

    /**
     * Synchronize the technologies attached to a project.
     *
     * @param  array<int, array{id: int, role_in_project?: string|null, sort_order?: int|null}>  $technologies
     */
    public function syncTechnologies(Project $project, array $technologies): void;
}
