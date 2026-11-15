<?php

/**
 * ExperienceRepositoryInterface
 *
 * Contract for reading and persisting the professional career timeline.
 */

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Models\Experience;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface ExperienceRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get all active experiences with their technologies and media.
     *
     * @return Collection<int, Experience>
     */
    public function getActive(): Collection;

    /**
     * Get the active experiences flagged as the current position.
     *
     * @return Collection<int, Experience>
     */
    public function getCurrent(): Collection;

    /**
     * Find an experience by ID with technologies and media eager loaded.
     *
     * @throws ModelNotFoundException
     */
    public function findByIdWithRelations(int $id): Experience;

    /**
     * Paginate experiences for the admin dashboard.
     *
     * @param  array{search?: string|null, employment_type?: string|null}  $filters
     * @return LengthAwarePaginator<Experience>
     */
    public function paginateForAdmin(int $perPage = 15, array $filters = []): LengthAwarePaginator;

    /**
     * Synchronize the technologies used in an experience.
     *
     * @param  array<int, int>  $technologyIds
     */
    public function syncTechnologies(Experience $experience, array $technologyIds): void;
}
