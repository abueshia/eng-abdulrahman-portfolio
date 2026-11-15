<?php

/**
 * EloquentServiceRepository
 *
 * Eloquent implementation of ServiceRepositoryInterface.
 */

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\Service;
use App\Repositories\Contracts\ServiceRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class EloquentServiceRepository extends BaseRepository implements ServiceRepositoryInterface
{
    /**
     * Initialize the repository with the Service model.
     */
    public function __construct(Service $model)
    {
        parent::__construct($model);
    }

    /**
     * {@inheritDoc}
     */
    public function getActive(): Collection
    {
        /** @var Collection<int, Service> $services */
        $services = $this->query()->with('media')->active()->ordered()->get();

        return $services;
    }

    /**
     * {@inheritDoc}
     */
    public function getFeatured(int $limit = 6): Collection
    {
        /** @var Collection<int, Service> $services */
        $services = $this->query()
            ->with('media')
            ->active()
            ->featured()
            ->ordered()
            ->limit($limit)
            ->get();

        return $services;
    }

    /**
     * {@inheritDoc}
     */
    public function findBySlugWithRelations(string $slug, bool $onlyActive = true): Service
    {
        /** @var Service $service */
        $service = $this->query()
            ->with('media')
            ->when($onlyActive, fn (Builder $query) => $query->active())
            ->where('slug', $slug)
            ->firstOrFail();

        return $service;
    }

    /**
     * {@inheritDoc}
     */
    public function paginateForAdmin(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        $query = $this->query()->with('media');

        $this->applySearch($query, $filters['search'] ?? null, ['title'], ['slug']);

        return $query->ordered()->paginate($perPage);
    }
}
