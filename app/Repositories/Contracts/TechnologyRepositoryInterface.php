<?php

/**
 * TechnologyRepositoryInterface
 *
 * Contract for reading and persisting the languages, frameworks and tools of the portfolio.
 */

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Enums\TechnologyCategoryEnum;
use App\Models\Technology;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface TechnologyRepositoryInterface extends SluggableRepositoryInterface
{
    /**
     * Get all active technologies.
     *
     * @return Collection<int, Technology>
     */
    public function getActive(): Collection;

    /**
     * Get the featured active technologies.
     *
     * @return Collection<int, Technology>
     */
    public function getFeatured(int $limit = 12): Collection;

    /**
     * Get the active technologies of a category.
     *
     * @return Collection<int, Technology>
     */
    public function getByCategory(TechnologyCategoryEnum $category): Collection;

    /**
     * Get active technologies grouped by their category value (e.g. `backend`, `frontend`).
     *
     * @return \Illuminate\Support\Collection<string, Collection<int, Technology>>
     */
    public function getGroupedByCategory(): \Illuminate\Support\Collection;

    /**
     * Find a technology by slug with its published projects (and their media) eager loaded.
     *
     * @throws ModelNotFoundException
     */
    public function findBySlugWithRelations(string $slug): Technology;

    /**
     * Paginate technologies for the admin dashboard.
     *
     * @param  array{search?: string|null, category?: string|null}  $filters
     * @return LengthAwarePaginator<Technology>
     */
    public function paginateForAdmin(int $perPage = 15, array $filters = []): LengthAwarePaginator;
}
