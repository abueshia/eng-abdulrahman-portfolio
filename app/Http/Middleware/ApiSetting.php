<?php

/**
 * ApiSetting Middleware
 *
 * Configures the application locale for incoming public API requests
 * based on the Accept-Language HTTP header ('ar' or 'en').
 */

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiSetting
{
    /**
     * Supported API locales.
     *
     * @var array<int, string>
     */
    private const SUPPORTED_LOCALES = ['ar', 'en'];

    /**
     * Handle an incoming API request and resolve the active locale.
     *
     * @param  Closure(Request): Response  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $requestedLocale = strtolower(trim((string) $request->header('Accept-Language', 'en')));
        $primaryLocale = substr($requestedLocale, 0, 2);

        $locale = in_array($primaryLocale, self::SUPPORTED_LOCALES, true)
            ? $primaryLocale
            : 'en';

        app()->setLocale($locale);

        return $next($request);
    }
}
