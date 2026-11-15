<?php

/**
 * StatRepositoryInterface
 *
 * Contract for reading and persisting the numeric highlights shown on the portfolio.
 */

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Models\Stat;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface StatRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get all active stats.
     *
     * @return Collection<int, Stat>
     */
    public function getActive(): Collection;

    /**
     * Paginate stats for the admin dashboard.
     *
     * @param  array{search?: string|null}  $filters
     * @return LengthAwarePaginator<Stat>
     */
    public function paginateForAdmin(int $perPage = 15, array $filters = []): LengthAwarePaginator;
}
