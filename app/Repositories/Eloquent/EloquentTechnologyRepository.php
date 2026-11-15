<?php

/**
 * EloquentTechnologyRepository
 *
 * Eloquent implementation of TechnologyRepositoryInterface.
 */

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Enums\TechnologyCategoryEnum;
use App\Models\Technology;
use App\Repositories\Contracts\TechnologyRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

class EloquentTechnologyRepository extends BaseRepository implements TechnologyRepositoryInterface
{
    /**
     * Initialize the repository with the Technology model.
     */
    public function __construct(Technology $model)
    {
        parent::__construct($model);
    }

    /**
     * {@inheritDoc}
     */
    public function getActive(): Collection
    {
        /** @var Collection<int, Technology> $technologies */
        $technologies = $this->query()->with('media')->active()->ordered()->get();

        return $technologies;
    }

    /**
     * {@inheritDoc}
     */
    public function getFeatured(int $limit = 12): Collection
    {
        /** @var Collection<int, Technology> $technologies */
        $technologies = $this->query()
            ->with('media')
            ->active()
            ->featured()
            ->ordered()
            ->limit($limit)
            ->get();

        return $technologies;
    }

    /**
     * {@inheritDoc}
     */
    public function getByCategory(TechnologyCategoryEnum $category): Collection
    {
        /** @var Collection<int, Technology> $technologies */
        $technologies = $this->query()
            ->with('media')
            ->active()
            ->byCategory($category)
            ->ordered()
            ->get();

        return $technologies;
    }

    /**
     * {@inheritDoc}
     */
    public function getGroupedByCategory(): SupportCollection
    {
        return $this->getActive()->groupBy(
            static fn (Technology $technology): string => $technology->category->value
        );
    }

    /**
     * {@inheritDoc}
     */
    public function findBySlugWithRelations(string $slug): Technology
    {
        /** @var Technology $technology */
        $technology = $this->query()
            ->with([
                'media',
                'projects' => fn ($query) => $query->published()->ordered()->with('media'),
            ])
            ->where('slug', $slug)
            ->firstOrFail();

        return $technology;
    }

    /**
     * {@inheritDoc}
     */
    public function paginateForAdmin(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        $query = $this->query()->with('media');

        $this->applySearch($query, $filters['search'] ?? null, ['name'], ['slug']);

        return $query
            ->when(
                ! empty($filters['category']),
                fn (Builder $builder) => $builder->byCategory(TechnologyCategoryEnum::from((string) $filters['category']))
            )
            ->ordered()
            ->paginate($perPage);
    }
}
