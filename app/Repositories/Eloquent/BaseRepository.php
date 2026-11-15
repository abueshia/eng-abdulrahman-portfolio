<?php

/**
 * BaseRepository
 *
 * Abstract Eloquent implementation of BaseRepositoryInterface providing common
 * CRUD, pagination, slug lookup, and reordering operations.
 */

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\BaseRepositoryInterface;
use App\Support\PortfolioLocale;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

abstract class BaseRepository implements BaseRepositoryInterface
{
    /**
     * Initialize the repository with its underlying Eloquent model.
     */
    public function __construct(
        protected readonly Model $model
    ) {}

    /**
     * Create a new Eloquent query builder instance for the model.
     *
     * @return Builder<Model>
     */
    protected function query(): Builder
    {
        return $this->model->newQuery();
    }

    /**
     * {@inheritDoc}
     */
    public function all(array $columns = ['*'], array $relations = []): Collection
    {
        $query = $this->query()->with($relations);

        if (method_exists($this->model, 'scopeOrdered')) {
            $query->ordered();
        }

        return $query->get($columns);
    }

    /**
     * {@inheritDoc}
     */
    public function paginate(int $perPage = 15, array $relations = []): LengthAwarePaginator
    {
        $query = $this->query()->with($relations);

        if (method_exists($this->model, 'scopeOrdered')) {
            $query->ordered();
        } else {
            $query->latest();
        }

        return $query->paginate($perPage);
    }

    /**
     * {@inheritDoc}
     */
    public function findById(int $id, array $relations = []): Model
    {
        return $this->query()->with($relations)->findOrFail($id);
    }

    /**
     * {@inheritDoc}
     */
    public function findBySlug(string $slug, array $relations = []): Model
    {
        return $this->query()
            ->with($relations)
            ->where('slug', $slug)
            ->firstOrFail();
    }

    /**
     * {@inheritDoc}
     */
    public function create(array $attributes): Model
    {
        return $this->query()->create($attributes);
    }

    /**
     * {@inheritDoc}
     */
    public function update(Model|int $modelOrId, array $attributes): Model
    {
        $instance = $modelOrId instanceof Model
            ? $modelOrId
            : $this->findById($modelOrId);

        $instance->update($attributes);

        return $instance->refresh();
    }

    /**
     * {@inheritDoc}
     */
    public function delete(Model|int $modelOrId): bool
    {
        $instance = $modelOrId instanceof Model
            ? $modelOrId
            : $this->findById($modelOrId);

        return (bool) $instance->delete();
    }

    /**
     * {@inheritDoc}
     */
    public function reorder(array $items): void
    {
        DB::transaction(function () use ($items): void {
            $position = 1;

            foreach ($items as $item) {
                $id = is_array($item)
                    ? (int) ($item['id'] ?? $item['item_id'] ?? 0)
                    : (int) $item;

                if ($id <= 0) {
                    continue;
                }

                $sortOrder = is_array($item) && isset($item['sort_order'])
                    ? (int) $item['sort_order']
                    : $position;

                $this->query()->whereKey($id)->update(['sort_order' => $sortOrder]);
                $position++;
            }
        });
    }

    /**
     * {@inheritDoc}
     */
    public function nextSortOrder(): int
    {
        return ((int) $this->query()->max('sort_order')) + 1;
    }

    /**
     * {@inheritDoc}
     */
    public function adminQuery(array $relations = []): Builder
    {
        $query = $this->query()->with($relations);

        if (method_exists($this->model, 'scopeOrdered')) {
            $query->ordered();
        }

        return $query;
    }

    /**
     * Determine whether a slug is already taken, optionally ignoring a specific record.
     *
     * Only meaningful for repositories implementing SluggableRepositoryInterface.
     */
    public function slugExists(string $slug, ?int $ignoreId = null): bool
    {
        return $this->query()
            ->where('slug', $slug)
            ->when($ignoreId !== null, fn (Builder $query) => $query->whereKeyNot($ignoreId))
            ->exists();
    }

    /**
     * Apply a case-insensitive "contains" search across translatable JSON and plain columns.
     *
     * @param  Builder<Model>  $query
     * @param  array<int, string>  $translatableColumns  JSON columns searched in every supported locale.
     * @param  array<int, string>  $plainColumns  Regular string columns.
     * @return Builder<Model>
     */
    protected function applySearch(
        Builder $query,
        ?string $term,
        array $translatableColumns = [],
        array $plainColumns = []
    ): Builder {
        $term = trim((string) $term);

        if ($term === '') {
            return $query;
        }

        $like = '%'.str_replace(['\\', '%', '_'], ['\\\\', '\\%', '\\_'], $term).'%';

        return $query->where(function (Builder $builder) use ($translatableColumns, $plainColumns, $like): void {
            foreach ($translatableColumns as $column) {
                foreach (PortfolioLocale::SUPPORTED as $locale) {
                    $builder->orWhere("{$column}->{$locale}", 'like', $like);
                }
            }

            foreach ($plainColumns as $column) {
                $builder->orWhere($column, 'like', $like);
            }
        });
    }
}
