<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponseTrait;
use Closure;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiSetting
{
    use ApiResponseTrait;

    public $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $defaultLang = 'en'; // depend on the app

        $lang = $request->header('Accept-Language');

        if (empty($lang) || !in_array($lang, ['en', 'ar'])) {
            app()->setLocale($defaultLang);
        } else {
            app()->setLocale($lang);
        }
        $api_key = $request->header('x-api-key');
        if($api_key == '0f69bd84-dff7-4725-9673-65f054646895') {
            return $next($request);
        } else {
            return $this->error_response('Un-Authorized Access', 403);
        }
    }

}
