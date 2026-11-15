<?php

/**
 * BlogRepositoryInterface
 *
 * Contract for reading and persisting bilingual technical blog articles.
 */

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Models\Blog;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface BlogRepositoryInterface extends SluggableRepositoryInterface
{
    /**
     * Get all published and active articles with category and media eager loaded.
     *
     * @return Collection<int, Blog>
     */
    public function getPublished(): Collection;

    /**
     * Get the featured published articles.
     *
     * @return Collection<int, Blog>
     */
    public function getFeatured(int $limit = 3): Collection;

    /**
     * Paginate published articles for the public blog with an optional category filter.
     *
     * @return LengthAwarePaginator<Blog>
     */
    public function paginatePublished(int $perPage = 9, ?int $categoryId = null): LengthAwarePaginator;

    /**
     * Find an article by slug with category and media eager loaded.
     *
     * @throws ModelNotFoundException
     */
    public function findBySlugWithRelations(string $slug, bool $onlyPublished = true): Blog;

    /**
     * Get published articles related to the given one (same category).
     *
     * @return Collection<int, Blog>
     */
    public function getRelated(Blog $blog, int $limit = 3): Collection;

    /**
     * Atomically increment the view counter of an article.
     */
    public function incrementViews(Blog $blog): void;

    /**
     * Paginate articles for the admin dashboard.
     *
     * @param  array{search?: string|null, status?: string|null, category_id?: int|string|null}  $filters
     * @return LengthAwarePaginator<Blog>
     */
    public function paginateForAdmin(int $perPage = 15, array $filters = []): LengthAwarePaginator;
}
