<?php

/**
 * PortfolioCache
 *
 * Version-based cache helper for public portfolio read models. Every module owns a
 * monotonically increasing version number embedded in its cache keys; flushing a module
 * simply bumps the version so stale entries become unreachable (and expire via TTL).
 * This works on every cache driver without requiring cache tags.
 */

declare(strict_types=1);

namespace App\Services\Support;

use Closure;
use Illuminate\Support\Facades\Cache;

class PortfolioCache
{
    /**
     * Time-to-live (in seconds) for cached read models (1 day).
     */
    public const TTL_SECONDS = 86400;

    /**
     * Retrieve a cached value for the module/variant pair or compute and store it.
     *
     * @template TValue
     *
     * @param  Closure(): TValue  $callback
     * @return TValue
     */
    public function remember(string $module, string $variant, Closure $callback): mixed
    {
        $key = sprintf('portfolio.%s.v%d.%s', $module, $this->version($module), $variant);

        return Cache::remember($key, self::TTL_SECONDS, $callback);
    }

    /**
     * Invalidate every cached entry of the given modules by bumping their versions.
     *
     * @param  array<int, string>  $modules
     */
    public function flush(array $modules): void
    {
        foreach (array_unique($modules) as $module) {
            Cache::forever($this->versionKey($module), $this->version($module) + 1);
        }
    }

    /**
     * Get the current cache version of a module.
     */
    public function version(string $module): int
    {
        return (int) Cache::get($this->versionKey($module), 1);
    }

    /**
     * Build the cache key holding the module version.
     */
    private function versionKey(string $module): string
    {
        return "portfolio.{$module}.version";
    }
}
