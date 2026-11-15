<?php

/**
 * StatService
 *
 * Manages quantitative portfolio statistics, reordering, and cache invalidation.
 */

declare(strict_types=1);

namespace App\Services;

use App\Models\Stat;
use App\Repositories\Contracts\StatRepositoryInterface;
use App\Services\Support\PortfolioCache;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class StatService
{
    public const CACHE_MODULE = 'stats';

    public function __construct(
        private readonly StatRepositoryInterface $statRepository,
        private readonly PortfolioCache $cache,
    ) {}

    /**
     * Get all active stats ordered by sort_order (cached).
     *
     * @return Collection<int, Stat>
     */
    public function getActive(): Collection
    {
        /** @var Collection<int, Stat> $stats */
        $stats = $this->cache->remember(
            self::CACHE_MODULE,
            'active',
            fn (): Collection => $this->statRepository->getActive(),
        );

        return $stats;
    }

    /**
     * Paginate stats for the Admin Dashboard.
     *
     * @param  array<string, mixed>  $filters
     */
    public function paginateForAdmin(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        return $this->statRepository->paginateForAdmin($perPage, $filters);
    }

    /**
     * Create a new stat entry from validated data.
     *
     * @param  array<string, mixed>  $validated
     */
    public function create(array $validated): Stat
    {
        $stat = DB::transaction(function () use ($validated): Stat {
            $validated['sort_order'] = isset($validated['sort_order']) && $validated['sort_order'] !== ''
                ? (int) $validated['sort_order']
                : $this->statRepository->nextSortOrder();

            /** @var Stat $created */
            $created = $this->statRepository->create($validated);

            return $created;
        });

        $this->flushCache();

        return $stat;
    }

    /**
     * Update an existing stat entry from validated data.
     *
     * @param  array<string, mixed>  $validated
     */
    public function update(Stat $stat, array $validated): Stat
    {
        $updated = DB::transaction(function () use ($stat, $validated): Stat {
            /** @var Stat $saved */
            $saved = $this->statRepository->update($stat, $validated);

            return $saved;
        });

        $this->flushCache();

        return $updated;
    }

    /**
     * Delete a stat entry.
     */
    public function delete(Stat $stat): bool
    {
        $deleted = DB::transaction(
            fn (): bool => $this->statRepository->delete($stat)
        );

        $this->flushCache();

        return $deleted;
    }

    /**
     * Reorder stats.
     *
     * @param  array<int, int|array{id: int, sort_order?: int}>  $items
     */
    public function reorder(array $items): void
    {
        DB::transaction(function () use ($items): void {
            $this->statRepository->reorder($items);
        });

        $this->flushCache();
    }

    /**
     * Flush cached stat query results.
     */
    public function flushCache(): void
    {
        $this->cache->flush([self::CACHE_MODULE]);
    }
}
