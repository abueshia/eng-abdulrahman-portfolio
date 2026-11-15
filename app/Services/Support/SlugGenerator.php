<?php

/**
 * SlugGenerator
 *
 * Generates unique, URL-safe ASCII slugs for sluggable modules by consulting the
 * repository contract (Dependency Inversion) instead of querying Eloquent directly.
 */

declare(strict_types=1);

namespace App\Services\Support;

use App\Repositories\Contracts\SluggableRepositoryInterface;
use Illuminate\Support\Str;

class SlugGenerator
{
    /**
     * Slug used when the source text cannot be transliterated to ASCII.
     */
    private const FALLBACK_SLUG = 'item';

    /**
     * Build a slug from the given text that is unique within the repository.
     */
    public function generate(
        SluggableRepositoryInterface $repository,
        string $source,
        ?int $ignoreId = null
    ): string {
        $base = Str::slug($source);
        $base = $base !== '' ? $base : self::FALLBACK_SLUG;

        $slug = $base;
        $suffix = 2;

        while ($repository->slugExists($slug, $ignoreId)) {
            $slug = "{$base}-{$suffix}";
            $suffix++;
        }

        return $slug;
    }
}
