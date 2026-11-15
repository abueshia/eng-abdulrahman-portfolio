<?php

/**
 * SluggableRepositoryInterface
 *
 * Extends the base repository contract for modules that expose a unique, URL-friendly
 * `slug` column (Project, Technology, Service, Category, Blog).
 */

declare(strict_types=1);

namespace App\Repositories\Contracts;

interface SluggableRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Determine whether a slug is already taken, optionally ignoring a specific record.
     */
    public function slugExists(string $slug, ?int $ignoreId = null): bool;
}
