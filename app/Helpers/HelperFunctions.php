<?php

/**
 * Global Helper Functions
 *
 * Provides navigation route helpers, dynamic setting retrieval,
 * and string/media formatting utilities across the application.
 */

declare(strict_types=1);

use App\Enums\SettingKeyEnum;
use App\Services\SettingService;
use Illuminate\Support\Facades\Route;

if (! function_exists('showLink')) {
    /**
     * Determine whether the given route name belongs to the current route's module prefix.
     */
    function showLink(string $routeName): string
    {
        $currentRoute = Route::currentRouteName() ?? '';
        $modulePrefix = explode('.', $routeName)[0] ?? '';

        return preg_match("/^{$modulePrefix}/", $currentRoute) ? 'here show' : '';
    }
}

if (! function_exists('activeLink')) {
    /**
     * Return the active CSS class if the given route prefix matches the current route.
     */
    function activeLink(string $routeName): string
    {
        $currentRoute = Route::currentRouteName() ?? '';
        $modulePrefix = explode('.', $routeName)[0] ?? '';

        return preg_match("/^{$modulePrefix}/", $currentRoute) ? 'active' : '';
    }
}

if (! function_exists('hoverLink')) {
    /**
     * Return the hover CSS class if the current route exactly matches the given route name.
     */
    function hoverLink(string $routeName): string
    {
        return Route::currentRouteName() === $routeName ? 'hover' : '';
    }
}

if (! function_exists('activeSingleLink')) {
    /**
     * Return the active CSS class if the current route exactly matches the given route name.
     */
    function activeSingleLink(string $routeName): string
    {
        return Route::currentRouteName() === $routeName ? 'active' : '';
    }
}

if (! function_exists('getLastKeyRoute')) {
    /**
     * Extract the action segment (last segment) of a dot-notated route name.
     */
    function getLastKeyRoute(string $routeName): string
    {
        $parts = explode('.', $routeName);

        return (string) end($parts);
    }
}

if (! function_exists('setting')) {
    /**
     * Retrieve a cached setting value via SettingService with locale and fallback support.
     */
    function setting(SettingKeyEnum|string $key, ?string $lang = null, mixed $default = null): mixed
    {
        try {
            return app(SettingService::class)->get($key, $lang, $default);
        } catch (Throwable) {
            return $default;
        }
    }
}

if (! function_exists('convertTags')) {
    /**
     * Convert a Tagify JSON string into a comma-separated string of tag values.
     */
    function convertTags(?string $tags): string
    {
        if (empty($tags)) {
            return '';
        }

        $decoded = json_decode($tags);
        if (! is_array($decoded)) {
            return $tags;
        }

        $values = array_map(static fn (object $tag): string => (string) ($tag->value ?? ''), $decoded);

        return implode(', ', array_filter($values));
    }
}

if (! function_exists('youtubeHandleLink')) {
    /**
     * Convert a standard YouTube watch URL into an embeddable URL.
     */
    function youtubeHandleLink(string $url): string
    {
        return str_replace('watch?v=', 'embed/', $url);
    }
}
