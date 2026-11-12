<?php

/**
 * ArchitectureFoundationTest
 *
 * Verifies Phase 1 architectural foundations including RepositoryServiceProvider
 * registration, public API locale resolution without x-api-key, rate-limiting
 * middleware on contact submission, and public route availability.
 */

declare(strict_types=1);

namespace Tests\Feature;

use App\Http\Middleware\ApiSetting;
use App\Providers\RepositoryServiceProvider;
use App\Repositories\Contracts\BaseRepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ArchitectureFoundationTest extends TestCase
{
    /**
     * Ensure RepositoryServiceProvider is registered in the Laravel application container.
     */
    public function test_repository_service_provider_is_registered(): void
    {
        $loadedProviders = $this->app->getLoadedProviders();

        $this->assertArrayHasKey(RepositoryServiceProvider::class, $loadedProviders);
        $this->assertTrue(interface_exists(BaseRepositoryInterface::class));
        $this->assertTrue(class_exists(BaseRepository::class));
    }

    /**
     * Ensure ApiSetting middleware resolves locale from Accept-Language without requiring x-api-key.
     */
    public function test_api_setting_middleware_sets_locale_without_api_key(): void
    {
        $middleware = new ApiSetting;

        $arabicRequest = Request::create('/api/test', 'GET');
        $arabicRequest->headers->set('Accept-Language', 'ar');

        $response = $middleware->handle($arabicRequest, static function (): Response {
            return new Response(app()->getLocale(), 200);
        });

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('ar', $response->getContent());

        $englishRequest = Request::create('/api/test', 'GET');
        $englishRequest->headers->set('Accept-Language', 'en-US,en;q=0.9');

        $enResponse = $middleware->handle($englishRequest, static function (): Response {
            return new Response(app()->getLocale(), 200);
        });

        $this->assertSame(200, $enResponse->getStatusCode());
        $this->assertSame('en', $enResponse->getContent());
    }

    /**
     * Ensure the API contact submission route is registered and protected by throttle middleware.
     */
    public function test_api_message_route_has_rate_limiting_middleware(): void
    {
        $route = Route::getRoutes()->getByName('api.message.store');

        $this->assertNotNull($route);
        $this->assertContains('throttle:5,1', $route->gatherMiddleware());
    }

    /**
     * Ensure the XML sitemap endpoint returns a valid XML response.
     */
    public function test_sitemap_endpoint_returns_xml_response(): void
    {
        $response = $this->get('/sitemap.xml');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/xml; charset=UTF-8');
        $response->assertSee('<urlset', false);
    }
}
