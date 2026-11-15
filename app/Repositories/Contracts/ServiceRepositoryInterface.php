<?php

/**
 * ServiceRepositoryInterface
 *
 * Contract for reading and persisting the software engineering services offered.
 */

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Models\Service;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface ServiceRepositoryInterface extends SluggableRepositoryInterface
{
    /**
     * Get all active services with media eager loaded.
     *
     * @return Collection<int, Service>
     */
    public function getActive(): Collection;

    /**
     * Get the featured active services.
     *
     * @return Collection<int, Service>
     */
    public function getFeatured(int $limit = 6): Collection;

    /**
     * Find an active service by slug with media eager loaded.
     *
     * @throws ModelNotFoundException
     */
    public function findBySlugWithRelations(string $slug, bool $onlyActive = true): Service;

    /**
     * Paginate services for the admin dashboard.
     *
     * @param  array{search?: string|null}  $filters
     * @return LengthAwarePaginator<Service>
     */
    public function paginateForAdmin(int $perPage = 15, array $filters = []): LengthAwarePaginator;
}
