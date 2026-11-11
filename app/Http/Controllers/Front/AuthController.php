<?php

namespace App\Http\Controllers\Front;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Front\Auth\LoginSubmitRequest;
use App\Http\Requests\Front\Auth\RegisterSubmitRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ***********login***********
    public function login()
    {
        return view('front.pages.user_dashboard.auth.login');

    }

    public function loginSubmit(LoginSubmitRequest $request)
    {
        // dd($request->username, $request->password);
        $auth = Auth::attempt(['email' => $request->username, 'password' => $request->password]);
        if ($auth) {
            return redirect()->route('site.home')->with(['success' => TranslationHelper::translate('Successfully Logged in')]);
        } else {

            return redirect()->back()->with(['error' => TranslationHelper::translate('Username or Password is incorrect')]);
        }
    }

// **************************register*****************************

    public function register()
    {
        return view('front.pages.user_dashboard.auth.register');
    }

  

    public function registerSubmit(RegisterSubmitRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = [
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'l_name'   => $request->l_name,
                'phone'    => $request->phone,
                'username' => $request->username,
            ];

            $validated = $request->validated();

            $user = User::create($data);

            DB::commit();

            Auth::guard('web')->login($user);

            return redirect()->route('site.home')->with([
                'success' => TranslationHelper::translate('Successfully Registered'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->withErrors([
                    'error' => 'An error occurred during registration. Please try again.',
                ]);
        }
    }



    // **************************logout************************
    public function logout()
    {
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }
        return redirect()->route('site.home');
    }


}
