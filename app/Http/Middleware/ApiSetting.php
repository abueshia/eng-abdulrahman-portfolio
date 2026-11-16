<?php

/**
 * ApiSetting Middleware
 *
 * Configures the application locale for incoming public API requests
 * based on the `?lang=ar|en` query parameter or the `Accept-Language` HTTP header,
 * and attaches HTTP cache headers (`ETag`, `Cache-Control`, `Vary`) to GET responses.
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
     * Handle an incoming API request, resolve the active locale, and apply HTTP cache headers.
     *
     * @param  Closure(Request): Response  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $this->resolveLocale($request);
        app()->setLocale($locale);

        $response = $next($request);

        if ($request->isMethod('GET') && $response->getStatusCode() === 200) {
            $content = (string) $response->getContent();
            $etag = '"'.sha1($locale.':'.$content).'"';

            $response->headers->set('ETag', $etag);
            $response->headers->set('Cache-Control', 'public, max-age=60, s-maxage=300');
            $response->headers->set('Vary', 'Accept-Language, Origin');

            $ifNoneMatch = trim((string) $request->header('If-None-Match', ''));
            if ($ifNoneMatch !== '' && $ifNoneMatch === $etag) {
                $response->setNotModified();
            }
        }

        return $response;
    }

    /**
     * Resolve the target locale (`ar` or `en`) from query string or Accept-Language header.
     */
    private function resolveLocale(Request $request): string
    {
        $queryLocale = strtolower(trim((string) ($request->query('lang') ?? $request->query('locale') ?? '')));
        if ($queryLocale !== '') {
            $shortQueryLocale = substr($queryLocale, 0, 2);
            if (in_array($shortQueryLocale, self::SUPPORTED_LOCALES, true)) {
                return $shortQueryLocale;
            }
        }

        $headerLocale = strtolower(trim((string) $request->header('Accept-Language', 'en')));
        $primaryLocale = substr($headerLocale, 0, 2);

        return in_array($primaryLocale, self::SUPPORTED_LOCALES, true)
            ? $primaryLocale
            : 'en';
    }
}
