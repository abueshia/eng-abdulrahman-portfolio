<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponseTrait;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAuthApi
{
    use ApiResponseTrait;
        /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request);
    // }

    // public function handle(Request $request, Closure $next)
    // {
    //     // التحقق من تسجيل الدخول باستخدام الجارد 'client'
    //     if (!Auth::guard('client')->check()) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Unauthorized',
    //             'data' => null
    //         ], 401);
    //     }

    //     return $next($request);
    // }

    public function handle(Request $request, Closure $next)
    {
        // التحقق من تسجيل الدخول باستخدام الجارد 'client'
        if (!Auth::guard('client_api')->check()) {
            return $this->unauthorized_response('Unauthorized', 401);
        }
        return $next($request);
    }
    
}
