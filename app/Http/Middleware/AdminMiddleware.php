<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
//   public function handle(Request $request, Closure $next)
//   {
//       if (!auth('admin')->check()) {
//           return redirect()->route('admin.login.form');
//       }
//       return $next($request);
//   }
public function handle(Request $request, Closure $next)
{
    // إذا كان الأدمن قد سجل الدخول
    if (auth('admin')->check()) {
        // إعادة توجيه الأدمن إلى لوحة التحكم أو الصفحة الرئيسية
        return redirect()->route('admin.index'); // أو المسار الذي ترغب فيه
    }
    // إذا لم يكن الأدمن قد سجل الدخول، متابعة التنفيذ
    return $next($request);
}

}
