<?php

/**
 * CategoryRepositoryInterface
 *
 * Contract for reading and persisting the categories shared by projects and blog articles.
 */

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface CategoryRepositoryInterface extends SluggableRepositoryInterface
{
    /**
     * Get all active categories.
     *
     * @return Collection<int, Category>
     */
    public function getActive(): Collection;

    /**
     * Get active categories with `projects_count` and `blogs_count` of published records.
     *
     * @return Collection<int, Category>
     */
    public function getActiveWithPublishedCounts(): Collection;

    /**
     * Find an active category by slug with its published projects and blogs eager loaded.
     *
     * @throws ModelNotFoundException
     */
    public function findBySlugWithRelations(string $slug, bool $onlyActive = true): Category;

    /**
     * Paginate categories for the admin dashboard.
     *
     * @param  array{search?: string|null}  $filters
     * @return LengthAwarePaginator<Category>
     */
    public function paginateForAdmin(int $perPage = 15, array $filters = []): LengthAwarePaginator;
}
