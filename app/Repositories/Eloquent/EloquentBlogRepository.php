<?php

/**
 * EloquentBlogRepository
 *
 * Eloquent implementation of BlogRepositoryInterface.
 */

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Enums\BlogStatusEnum;
use App\Models\Blog;
use App\Repositories\Contracts\BlogRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class EloquentBlogRepository extends BaseRepository implements BlogRepositoryInterface
{
    /**
     * Relations eager loaded for article reads.
     *
     * @var array<int, string>
     */
    private const RELATIONS = ['category', 'media'];

    /**
     * Initialize the repository with the Blog model.
     */
    public function __construct(Blog $model)
    {
        parent::__construct($model);
    }

    /**
     * {@inheritDoc}
     */
    public function getPublished(): Collection
    {
        /** @var Collection<int, Blog> $blogs */
        $blogs = $this->query()->with(self::RELATIONS)->published()->ordered()->get();

        return $blogs;
    }

    /**
     * {@inheritDoc}
     */
    public function getFeatured(int $limit = 3): Collection
    {
        /** @var Collection<int, Blog> $blogs */
        $blogs = $this->query()
            ->with(self::RELATIONS)
            ->published()
            ->featured()
            ->ordered()
            ->limit($limit)
            ->get();

        return $blogs;
    }

    /**
     * {@inheritDoc}
     */
    public function paginatePublished(int $perPage = 9, ?int $categoryId = null): LengthAwarePaginator
    {
        return $this->query()
            ->with(self::RELATIONS)
            ->published()
            ->when($categoryId !== null, fn (Builder $query) => $query->where('category_id', $categoryId))
            ->ordered()
            ->paginate($perPage);
    }

    /**
     * {@inheritDoc}
     */
    public function findBySlugWithRelations(string $slug, bool $onlyPublished = true): Blog
    {
        /** @var Blog $blog */
        $blog = $this->query()
            ->with(self::RELATIONS)
            ->when($onlyPublished, fn (Builder $query) => $query->published())
            ->where('slug', $slug)
            ->firstOrFail();

        return $blog;
    }

    /**
     * {@inheritDoc}
     */
    public function getRelated(Blog $blog, int $limit = 3): Collection
    {
        if ($blog->category_id === null) {
            return $blog->newCollection();
        }

        /** @var Collection<int, Blog> $blogs */
        $blogs = $this->query()
            ->with(self::RELATIONS)
            ->published()
            ->whereKeyNot($blog->getKey())
            ->where('category_id', $blog->category_id)
            ->ordered()
            ->limit($limit)
            ->get();

        return $blogs;
    }

    /**
     * {@inheritDoc}
     */
    public function incrementViews(Blog $blog): void
    {
        $blog->increment('views_count');
    }

    /**
     * {@inheritDoc}
     */
    public function paginateForAdmin(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        $query = $this->query()->with(self::RELATIONS);

        $this->applySearch($query, $filters['search'] ?? null, ['name'], ['slug']);

        return $query
            ->when(
                ! empty($filters['status']),
                fn (Builder $builder) => $builder->where('status', BlogStatusEnum::from((string) $filters['status'])->value)
            )
            ->when(
                ! empty($filters['category_id']),
                fn (Builder $builder) => $builder->where('category_id', (int) $filters['category_id'])
            )
            ->ordered()
            ->paginate($perPage);
    }
}
