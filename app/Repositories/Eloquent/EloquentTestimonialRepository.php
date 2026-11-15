<?php

/**
 * EloquentTestimonialRepository
 *
 * Eloquent implementation of TestimonialRepositoryInterface.
 */

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\Testimonial;
use App\Repositories\Contracts\TestimonialRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class EloquentTestimonialRepository extends BaseRepository implements TestimonialRepositoryInterface
{
    /**
     * Relations eager loaded for testimonial reads.
     *
     * @var array<int, string>
     */
    private const RELATIONS = ['project', 'media'];

    /**
     * Initialize the repository with the Testimonial model.
     */
    public function __construct(Testimonial $model)
    {
        parent::__construct($model);
    }

    /**
     * {@inheritDoc}
     */
    public function getActive(): Collection
    {
        /** @var Collection<int, Testimonial> $testimonials */
        $testimonials = $this->query()->with(self::RELATIONS)->active()->ordered()->get();

        return $testimonials;
    }

    /**
     * {@inheritDoc}
     */
    public function getFeatured(int $limit = 6): Collection
    {
        /** @var Collection<int, Testimonial> $testimonials */
        $testimonials = $this->query()
            ->with(self::RELATIONS)
            ->active()
            ->featured()
            ->ordered()
            ->limit($limit)
            ->get();

        return $testimonials;
    }

    /**
     * {@inheritDoc}
     */
    public function getByProject(int $projectId): Collection
    {
        /** @var Collection<int, Testimonial> $testimonials */
        $testimonials = $this->query()
            ->with('media')
            ->active()
            ->where('project_id', $projectId)
            ->ordered()
            ->get();

        return $testimonials;
    }

    /**
     * {@inheritDoc}
     */
    public function countActive(): int
    {
        return $this->query()->active()->count();
    }

    /**
     * {@inheritDoc}
     */
    public function averageRating(): float
    {
        return round((float) $this->query()->active()->avg('rating'), 1);
    }

    /**
     * {@inheritDoc}
     */
    public function paginateForAdmin(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        $query = $this->query()->with(self::RELATIONS);

        $this->applySearch($query, $filters['search'] ?? null, ['name', 'company_name', 'description']);

        return $query
            ->when(
                ! empty($filters['rating']),
                fn (Builder $builder) => $builder->where('rating', (int) $filters['rating'])
            )
            ->ordered()
            ->paginate($perPage);
    }
}
