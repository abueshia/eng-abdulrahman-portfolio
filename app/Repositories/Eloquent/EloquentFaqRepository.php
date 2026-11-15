<?php

/**
 * EloquentFaqRepository
 *
 * Eloquent implementation of FaqRepositoryInterface.
 */

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\Faq;
use App\Repositories\Contracts\FaqRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class EloquentFaqRepository extends BaseRepository implements FaqRepositoryInterface
{
    /**
     * Initialize the repository with the Faq model.
     */
    public function __construct(Faq $model)
    {
        parent::__construct($model);
    }

    /**
     * {@inheritDoc}
     */
    public function getActive(): Collection
    {
        /** @var Collection<int, Faq> $faqs */
        $faqs = $this->query()->active()->ordered()->get();

        return $faqs;
    }

    /**
     * {@inheritDoc}
     */
    public function getByCategory(string $category): Collection
    {
        /** @var Collection<int, Faq> $faqs */
        $faqs = $this->query()->active()->where('category', $category)->ordered()->get();

        return $faqs;
    }

    /**
     * {@inheritDoc}
     */
    public function paginateForAdmin(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        $query = $this->query();

        $this->applySearch($query, $filters['search'] ?? null, ['question', 'answer']);

        return $query
            ->when(
                ! empty($filters['category']),
                fn (Builder $builder) => $builder->where('category', (string) $filters['category'])
            )
            ->ordered()
            ->paginate($perPage);
    }
}
