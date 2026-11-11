<?php

namespace App\Http\Middleware;

use App\Helpers\TranslationHelper;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->check()) {
            return $next($request);
        } else {
            return redirect()->route('user.login.form')->with(['error', TranslationHelper::translate('Please Login First !!')]);
        }
    }
}
