<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;

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
