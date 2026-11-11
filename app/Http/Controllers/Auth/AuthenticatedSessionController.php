<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{

    /**
     * Store FCM Token
     */
    public function storeToken(Request $request) {
        if (auth()->check()) {
            Auth::user()->cm_firebase_token = $request->token;
            Auth::user()->save();
            return response()->json(['Token Updated Successfully']);
        } else {
            return response()->json(['Some Error Happened .. Please Allow Send Notifications']);
        }
    }

    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('admin.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    // كنترول الصحيح ل نظام العملية
    // public function store(LoginRequest $request): RedirectResponse
    // {
    //     $request->authenticate();

    //     $request->session()->regenerate();

    //     return redirect()->intended(RouteServiceProvider::HOME);
    // }
    public function store(LoginRequest $request): RedirectResponse
    {
        // تحقق من المصادقة باستخدام الحارس الخاص بالأدمن
        $request->authenticate('admin');

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }
    

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // تسجيل الخروج من الحارس الخاص بالأدمن
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin'); // توجيه المستخدم إلى الصفحة الرئيسية أو أي صفحة أخرى
    }
}
