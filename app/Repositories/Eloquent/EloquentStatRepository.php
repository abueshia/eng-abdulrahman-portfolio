<?php

/**
 * EloquentStatRepository
 *
 * Eloquent implementation of StatRepositoryInterface.
 */

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\Stat;
use App\Repositories\Contracts\StatRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class EloquentStatRepository extends BaseRepository implements StatRepositoryInterface
{
    /**
     * Initialize the repository with the Stat model.
     */
    public function __construct(Stat $model)
    {
        parent::__construct($model);
    }

    /**
     * {@inheritDoc}
     */
    public function getActive(): Collection
    {
        /** @var Collection<int, Stat> $stats */
        $stats = $this->query()->active()->ordered()->get();

        return $stats;
    }

    /**
     * {@inheritDoc}
     */
    public function paginateForAdmin(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        $query = $this->query();

        $this->applySearch($query, $filters['search'] ?? null, ['label'], ['value']);

        return $query->ordered()->paginate($perPage);
    }
}
