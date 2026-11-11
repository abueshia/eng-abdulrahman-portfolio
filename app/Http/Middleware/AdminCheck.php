<?php

namespace App\Http\Middleware;

use App\Helpers\TranslationHelper;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminCheck
{
    //        dd(auth()->check());

public function handle($request, Closure $next)
    {
        if (auth('admin')->check()) {
            return $next($request);
        }
        return redirect('/admin/login')->with('error', 'Access Denied');
    }
}
