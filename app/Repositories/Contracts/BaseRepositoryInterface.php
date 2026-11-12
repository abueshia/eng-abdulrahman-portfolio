<?php

/**
 * BaseRepositoryInterface
 *
 * Defines the standard contract for all Eloquent repositories in the application,
 * ensuring adherence to the Dependency Inversion Principle (DIP).
 */

declare(strict_types=1);

namespace App\Repositories\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    /**
     * Retrieve all records ordered by default sorting.
     *
     * @param  array<int, string>  $columns
     * @param  array<int, string>  $relations
     * @return Collection<int, Model>
     */
    public function all(array $columns = ['*'], array $relations = []): Collection;

    /**
     * Paginate records with optional relations and filters.
     *
     * @param  array<int, string>  $relations
     */
    public function paginate(int $perPage = 15, array $relations = []): LengthAwarePaginator;

    /**
     * Find a record by its primary key ID or throw ModelNotFoundException.
     *
     * @param  array<int, string>  $relations
     */
    public function findById(int $id, array $relations = []): Model;

    /**
     * Find a record by its unique slug or throw ModelNotFoundException.
     *
     * @param  array<int, string>  $relations
     */
    public function findBySlug(string $slug, array $relations = []): Model;

    /**
     * Create a new model instance in the database.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function create(array $attributes): Model;

    /**
     * Update an existing model instance in the database.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function update(Model|int $modelOrId, array $attributes): Model;

    /**
     * Delete a model instance from the database.
     */
    public function delete(Model|int $modelOrId): bool;

    /**
     * Update the sort order of multiple records.
     *
     * @param  array<int, int|array<string, mixed>>  $items
     */
    public function reorder(array $items): void;
}
