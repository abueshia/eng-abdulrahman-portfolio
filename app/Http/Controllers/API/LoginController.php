<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserApp\ClientResource;
use App\Models\Client;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

// use Laravel\Passport\HasApiTokens; 

class LoginController extends Controller
{

    use ApiResponseTrait;

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return $this->error_response('البيانات المدخلة غير صحيحة.', 422);
        }

        $client = Client::where('phone', $request->phone)->first();

        if (!$client || !Hash::check($request->password, $client->password)) {
            return $this->unauthorized_response('رقم الهاتف أو كلمة المرور غير صحيحة.');
        }

        // إنشاء الـ API Token باستخدام Passport
        $token = $client->createToken('ClientApp')->accessToken;

        // تضمين الـ token في الموارد

        $client->token = $token;

        $data = new ClientResource($client);

        return $this->success_response($data, 'تم تسجيل الدخول بنجاح');
    }


    

    public function LogOut(Request $request)
    {
        $client = $request->user('client_api');
        if ($client) {
            $client->tokens()->delete();
            return $this->success_response([], 'تم تسجيل الخروج بنجاح');
        }
        return $this->error_response('لم يتم العثور على العميل أو لم يتم تسجيل الدخول.', 401);
    }



    public function ChangePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed', 
        ]);

        $client = auth('client_api')->user();
        // $client = $request->user('client_api');

        if (!$client) {
            return $this->error_response('لم يتم العثور على العميل.', 404);
        }

        if (!Hash::check($request->old_password, $client->password)) {
            return $this->error_response('كلمة المرور القديمة غير صحيحة.', 400);
        }

        $client->password = Hash::make($request->new_password);
        $client->save();

        return $this->success_response([], 'تم تغيير كلمة المرور بنجاح');
    }



    public function DeleteAccount(Request $request)
    {
        try {
            $user = auth('client_api')->user();
            if (!$user) {
                return $this->error_response('User not authenticated', 401);
            }
            DB::transaction(function () use ($user) {
                $user->delete();
            });
            $user->tokens->each(function ($token) {
                $token->revoke();
            });
            return $this->success_response([], 'Account deleted successfully.');
        } catch (\Exception $e) {
            return $this->error_response('Failed to delete account: ' . $e->getMessage(), 500);
        }
    }


  


}
