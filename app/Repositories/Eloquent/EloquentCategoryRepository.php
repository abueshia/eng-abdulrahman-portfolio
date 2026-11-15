<?php

/**
 * EloquentCategoryRepository
 *
 * Eloquent implementation of CategoryRepositoryInterface.
 */

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class EloquentCategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    /**
     * Initialize the repository with the Category model.
     */
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    /**
     * {@inheritDoc}
     */
    public function getActive(): Collection
    {
        /** @var Collection<int, Category> $categories */
        $categories = $this->query()->with('media')->active()->ordered()->get();

        return $categories;
    }

    /**
     * {@inheritDoc}
     */
    public function getActiveWithPublishedCounts(): Collection
    {
        /** @var Collection<int, Category> $categories */
        $categories = $this->query()
            ->with('media')
            ->active()
            ->withCount([
                'projects as projects_count' => fn (Builder $query) => $query->published(),
                'blogs as blogs_count' => fn (Builder $query) => $query->published(),
            ])
            ->ordered()
            ->get();

        return $categories;
    }

    /**
     * {@inheritDoc}
     */
    public function findBySlugWithRelations(string $slug, bool $onlyActive = true): Category
    {
        /** @var Category $category */
        $category = $this->query()
            ->with([
                'media',
                'projects' => fn ($query) => $query->published()->ordered()->with('media'),
                'blogs' => fn ($query) => $query->published()->ordered()->with('media'),
            ])
            ->when($onlyActive, fn (Builder $query) => $query->active())
            ->where('slug', $slug)
            ->firstOrFail();

        return $category;
    }

    /**
     * {@inheritDoc}
     */
    public function paginateForAdmin(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        $query = $this->query()->with('media')->withCount(['projects', 'blogs']);

        $this->applySearch($query, $filters['search'] ?? null, ['name'], ['slug']);

        return $query->ordered()->paginate($perPage);
    }
}
