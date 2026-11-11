<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserApp\ClientResource;
use App\Models\Client;
use App\Models\Otp;
use App\Models\Pointssetting;
// use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponseTrait;
use App\Traits\HandleUploadFile;
// use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ClientController extends Controller
{
    use ApiResponseTrait, HandleUploadFile;

    // public function sendOtp(Request $request)
    // {
    //     $request->validate([
    //         'phone' => [
    //             'required',
    //             Rule::unique('clients', 'phone')->where(function ($query) {
    //                 return $query->whereNotNull('phone');
    //             }),
    //             Rule::unique('otp', 'phone'), 
    //         ],
    //     ], [
    //         'phone.required' => 'رقم الهاتف مطلوب.',
    //         'phone.unique' => 'رقم الهاتف موجود بالفعل.',
    //     ]);

    //     // إنشاء كود جديد
    //     $otp = new Otp();
    //     $otp->phone = $request->phone;
    //     $otp->code = '0000';
    //     $otp->save();
    //     return $this->success_response(['otp' => $otp->code], 'OTP sent successfully');
    // }


    public function sendOtp(Request $request)
    {
        $request->validate([
            'phone' => [
                'required',
                // 'regex:/^[0-9]{10,15}$/', 
            ],
        ], [
            'phone.required' => 'رقم الهاتف مطلوب.',
            // 'phone.regex' => 'رقم الهاتف غير صالح.',
        ]);
        // تحقق مما إذا كان الرقم مسجلًا بالفعل كعميل
        $existingClient = Client::where('phone', $request->phone)->first();
        if ($existingClient) {
            return $this->error_response('رقم الهاتف مسجل بالفعل. يرجى تسجيل الدخول.', 400);
        }

        // إنشاء أو تحديث كود OTP
        $otp = Otp::updateOrCreate(
            ['phone' => $request->phone], // البحث عن السجل بناءً على رقم الهاتف
            ['code' => '0000'] // إنشاء أو تحديث الكود
        );

        return $this->success_response(['otp' => $otp->code], 'تم إرسال كود OTP بنجاح.');
    }

  
    public function checkOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'code' => 'required|digits:4',
        ]);
        $otp = Otp::where('phone',$request->phone)->where('is_active',1)->first();
        if(!$otp){
            return $this->error_response('phone not found', 400);
        }
        if ($request->code !== $otp->code ) {
            return $this->error_response('Invalid verification code', 400);
        }
        $otp->is_active = false;
        $otp->save();
        return $this->success_response([], 'Verification successful');
    }



    // public function register(Request $request)
    // {
    //     $request->validate([
    //         'phone' => 'required|exists:otp,phone', // الرقم يجب أن يكون موجودًا في جدول OTP
    //         'password' => 'required|confirmed|min:6',
    //     ], [
    //         'phone.exists' => 'رقم الهاتف غير موجود. يرجى طلب OTP أولاً.',
    //     ]);

    //     // حذف السجل من جدول OTP بعد التسجيل
    //     Otp::where('phone', $request->phone)->delete();


    //     // إنشاء العميل
    //     $client = Client::create([
    //         'phone' => $request->phone,
    //         'password' => Hash::make($request->password)
    //     ]);

    //     // توليد كود خاص بالعميل إذا لم يكن موجودًا
    //     if (!$client->code_for_client) {
    //         $client->update([
    //             'code_for_client' => Str::random(8)
    //         ]);
    //     }


    //     $data = new ClientResource($client);
    //     return $this->success_response($data, 'Client registered successfully');
    // }

    public function register(Request $request)
    {
        $request->validate([
            'phone' => 'required|exists:otp,phone',
            'password' => 'required|confirmed|min:6',
        ], [
            'phone.exists' => 'رقم الهاتف غير موجود. يرجى طلب OTP أولاً.',
        ]);

        $otp = Otp::where('phone', $request->phone)->first();
        if ($otp) {
            $otp->delete();
        }

        $client = Client::create([
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'code_for_client' => Str::random(8),  
        ]);

        $data = new ClientResource($client);
        return $this->success_response($data, 'Client registered successfully');
    }
    


    // public function updateMyProfile(Request $request)
    // {
    //     try {
    //         $client = auth('client_api')->user();

    //         // التحقق من صحة المدخلات
    //         $validator = Validator::make($request->all(), [
    //             'name' => $client->name ? 'nullable|string|max:255' : 'required|string|max:255',
    //             'city_id' => $client->city_id ? 'nullable|exists:cities,id' : 'required|exists:cities,id',
    //             'card' => [
    //                 $client->card ? 'nullable' : 'required',
    //                 'digits_between:1,14',
    //                 Rule::unique('clients', 'card')->ignore($client->id),
    //             ],
    //             'image' => $client->getMedia('clients')->count() ? 'nullable' : 'required',
    //             'imageprofile' => 'nullable',
    //             'paintscategories' => $client->paintscategories->isNotEmpty() ? 'nullable|array' : 'required|array',
    //             'paintscategories.*' => 'exists:paints_category,id',
    //         ], [
    //             'name.required' => 'اسم العميل مطلوب.',
    //             'city_id.required' => 'المدينة مطلوبة.',
    //             'card.required' => 'رقم البطاقة مطلوب.',
    //             'card.digits_between' => 'يجب أن يكون رقم البطاقة مكونًا من 1 إلى 14 رقمًا فقط.',
    //             'card.unique' => 'رقم البطاقة تم استخدامه من قبل.',
    //             'image.required' => 'صورة العميل مطلوبة.',
    //             'paintscategories.required' => 'يجب اختيار الفئات الخاصة بالدهانات.',
    //         ]);

    //         if ($validator->fails()) {
    //             return $this->error_response($validator->errors()->first(), 422);
    //         }



    //         // تحديث بيانات العميل
    //         $client->update([
    //             'name' => $request->name,
    //             'city_id' => $request->city_id,
    //             'card' => $request->card,
    //         ]);

    //         // تحديث الصور إذا وجدت
    //         if ($request->hasFile('image')) {
    //             $client->clearMediaCollection('clients');
    //             $client->addMedia($request->file('image'))->toMediaCollection('clients');
    //         }

    //         if ($request->hasFile('imageprofile')) {
    //             $client->clearMediaCollection('clients_profile');
    //             $client->addMedia($request->file('imageprofile'))->toMediaCollection('clients_profile');
    //         }

    //         $client->paintscategories()->sync($request->paintscategories);

    //         return $this->success_response(
    //             new ClientResource($client),
    //             'تم تحديث معلومات العميل بنجاح'
    //         );
    //     } catch (\Exception $e) {
    //         return $this->error_response('حدث خطأ غير متوقع', 500);
    //     }
    // }


    public function updateMyProfile(Request $request)
    {
        try {
            $client = auth('client_api')->user();

            // التحقق من صحة المدخلات
            $validator = Validator::make($request->all(), [
                'name' => $client->name ? 'nullable|string|max:255' : 'required|string|max:255',
                'city_id' => $client->city_id ? 'nullable|exists:cities,id' : 'required|exists:cities,id',
                'card' => [
                    $client->card ? 'nullable' : 'required',
                    'digits_between:1,14',
                    Rule::unique('clients', 'card')->ignore($client->id),
                ],
                'image' => $client->getMedia('clients_image')->count() ? 'nullable' : 'required',
                'imageprofile' => 'nullable',
                'paintscategories' => $client->paintscategories->isNotEmpty() ? 'nullable|array' : 'required|array',
                'paintscategories.*' => 'exists:paints_category,id',
                // 'code_add_invite_friend' => 'nullable|string|exists:clients,code_for_client', 
            ], [
                'name.required' => 'اسم العميل مطلوب.',
                'city_id.required' => 'المدينة مطلوبة.',
                'card.required' => 'رقم البطاقة مطلوب.',
                'card.digits_between' => 'يجب أن يكون رقم البطاقة مكونًا من 1 إلى 14 رقمًا فقط.',
                'card.unique' => 'رقم البطاقة تم استخدامه من قبل.',
                'image.required' => 'صورة العميل مطلوبة.',
                'paintscategories.required' => 'يجب اختيار الفئات الخاصة بالدهانات.',
                // 'code_add_invite_friend.exists' => 'كود الدعوة غير صحيح.',
            ]);

            if ($validator->fails()) {
                return $this->error_response($validator->errors()->first(), 422);
            }

            // تحديث بيانات العميل
            $client->update([
                'name' => $request->name,
                'city_id' => $request->city_id,
                'card' => $request->card,
            ]);

            if ($request->hasFile('image')) {
                $client->clearMediaCollection('clients_image');
                $client->addMedia($request->file('image'))->toMediaCollection('clients_image');
            }

     
            if ($request->hasFile('imageprofile')) {
                $client->clearMediaCollection('client_profile'); 
                $client->addMedia($request->file('imageprofile'))->toMediaCollection('client_profile');
            }

            $client->paintscategories()->sync($request->paintscategories);

            if ($request->filled('code_add_invite_friend')) {
                $inviterClient = Client::where('code_for_client', $request->code_add_invite_friend)->first();

                if ($inviterClient && $inviterClient->id !== $client->id) {
                    $pointsSetting = PointsSetting::first();

                    $invitePoints = $pointsSetting->invite_friend ?? 0;

                    // $client->points +=  $invitePoints;
                    // $client->save();

                    $inviterClient->points += $invitePoints;
                    $inviterClient->save();

                }
            }

            return $this->success_response(
                new ClientResource($client),
                'تم تحديث معلومات العميل بنجاح'
            );
        } catch (\Exception $e) {
            return $this->error_response('حدث خطأ غير متوقع', 500);
        }
    }



    public function getMyProfile() {
        $client = auth('client_api')->user();
        $data = new ClientResource($client);
        return $this->success_response($data, 'My Profile');
    }

    public function updateImage(Request $request)
    {
        $client = auth('client_api')->user();

        if ($request->hasFile('imageprofile')) {
            $client->clearMediaCollection('client_profile');
            $client->addMedia($request->file('imageprofile'))->toMediaCollection('client_profile');
        }

        return $this->success_response([], 'تم التحديث بنجاح');
    }




    public function updateFcmToken(Request $request)
    {
        $client = auth('client_api')->user();
        if (!$client) {
            return $this->error_response('User not authenticated', 401);
        }
        $client->fcm_token = $request->fcm_token;
        $client->save();
        return $this->success_response([], 'Token updated successfully.');
    }
    




    public function clientPoints(Request $request)
    {
        // التحقق من البيانات المدخلة
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'points' => 'required|numeric|min:1',
        ]);

        // العثور على العميل
        $client = Client::find($request->client_id);

        $client->points += $request->points;

        $client->save();

        return $this->success_response([], 'updated successfully.');
    }



  

    // public function updateMyProfile(Request $request)
    // {
    //     try {
    //         $client = auth('client_api')->user(); 

    //         $validator = Validator::make($request->all(), [
    //             'name' => $client->name ? 'nullable|string|max:255' : 'required|string|max:255',
    //             'city_id' => $client->city_id ? 'nullable|exists:cities,id' : 'required|exists:cities,id',
    //             'card' => [
    //                 $client->card ? 'nullable' : 'required',
    //                 'digits_between:1,14',
    //                 Rule::unique('clients', 'card')->ignore($client->id),
    //             ],
    //             'image' => $client->getMedia('clients')->count() ? 'nullable' : 'required',
    //             // 'imageprofile' => $client->getMedia('clients_profile')->count() ? 'nullable' : 'required',
    //             'imageprofile' => 'nullable',
    //             'paintscategories' => $client->paintscategories->isNotEmpty() ? 'nullable|array' : 'required|array',
    //             'paintscategories.*' => 'exists:paints_category,id',
    //         ], [
    //             'name.required' => 'اسم العميل مطلوب.',
    //             'name.string' => 'يجب أن يكون الاسم نصًا.',
    //             'city_id.required' => 'المدينة مطلوبة.',
    //             'card.required' => 'رقم البطاقة مطلوب.',
    //             'card.digits_between' => 'يجب أن يكون رقم البطاقة مكونًا من 1 إلى 14 رقمًا فقط.',
    //             'card.unique' => 'رقم البطاقة تم استخدامه من قبل.',
    //             'image.required' => 'صورة العميل مطلوبة.',
    //             'image.file' => 'يجب أن يكون الملف صورة صالحة.',
    //             'image.image' => 'يجب أن يكون الملف صورة (jpg, png, ...).',
    //             'image.max' => 'يجب ألا يزيد حجم الصورة عن 2 ميجا بايت.',
    //             'paintscategories.required' => 'يجب اختيار الفئات الخاصة بالدهانات.',
    //             'paintscategories.array' => 'يجب أن تكون الفئات عبارة عن مصفوفة.',
    //             'paintscategories.*.exists' => 'الفئة المحددة غير موجودة.',
    //         ]);

    //         if ($validator->fails()) {
    //             return $this->error_response($validator->errors()->first(), 422);
    //         }

    //         $client->update([
    //             'name' => $request->name,
    //             'city_id' => $request->city_id,
    //             'card' => $request->card,
    //         ]);

    //         if ($request->hasFile('image')) {
    //             $client->clearMediaCollection('clients');
    //             $client->addMedia($request->file('image'))->toMediaCollection('clients');
    //         }

    //         if ($request->hasFile('imageprofile')) {
    //             $client->clearMediaCollection('clients_profile');
    //             $client->addMedia($request->file('imageprofile'))->toMediaCollection('clients_profile');
    //         }

    //         $client->paintscategories()->sync($request->paintscategories);

    //         return $this->success_response(
    //             new ClientResource($client),
    //             'تم تحديث معلومات العميل بنجاح'
    //         );
    //     } catch (\Exception $e) {
    //         return $this->error_response('حدث خطأ غير متوقع', 500);
    //     }
    // }

    // public function updateMyProfile(Request $request)
    // {
    //     try {
    //         $client = auth('client_api')->user();

    //         $validator = Validator::make($request->all(), [
    //             'name' => $client->name ? 'nullable|string|max:255' : 'required|string|max:255',
    //             'city_id' => $client->city_id ? 'nullable|exists:cities,id' : 'required|exists:cities,id',
    //             'card' => [
    //                 $client->card ? 'nullable' : 'required',
    //                 'digits_between:1,14',
    //                 Rule::unique('clients', 'card')->ignore($client->id),
    //             ],
    //             'image' => $client->getMedia('clients')->count() ? 'nullable' : 'required',
    //             'imageprofile' => 'nullable',
    //             'paintscategories' => $client->paintscategories->isNotEmpty() ? 'nullable|array' : 'required|array',
    //             'paintscategories.*' => 'exists:paints_category,id',
    //         ], [
    //             'name.required' => 'اسم العميل مطلوب.',
    //             'city_id.required' => 'المدينة مطلوبة.',
    //             'card.required' => 'رقم البطاقة مطلوب.',
    //             'card.digits_between' => 'يجب أن يكون رقم البطاقة مكونًا من 1 إلى 14 رقمًا فقط.',
    //             'card.unique' => 'رقم البطاقة تم استخدامه من قبل.',
    //             'image.required' => 'صورة العميل مطلوبة.',
    //             'paintscategories.required' => 'يجب اختيار الفئات الخاصة بالدهانات.',
    //         ]);

    //         if ($validator->fails()) {
    //             return $this->error_response($validator->errors()->first(), 422);
    //         }

    //         // تحديث بيانات العميل
    //         $client->update([
    //             'name' => $request->name,
    //             'city_id' => $request->city_id,
    //             'card' => $request->card,

    //             // code_for_client
    //         ]);

    //         // تحديث الصور إذا وجدت
    //         if ($request->hasFile('image')) {
    //             $client->clearMediaCollection('clients');
    //             $client->addMedia($request->file('image'))->toMediaCollection('clients');
    //         }

    //         if ($request->hasFile('imageprofile')) {
    //             $client->clearMediaCollection('clients_profile');
    //             $client->addMedia($request->file('imageprofile'))->toMediaCollection('clients_profile');
    //         }

    //         $client->paintscategories()->sync($request->paintscategories);

    //         return $this->success_response(
    //             new ClientResource($client),
    //             'تم تحديث معلومات العميل بنجاح'
    //         );
    //     } catch (\Exception $e) {
    //         return $this->error_response('حدث خطأ غير متوقع', 500);
    //     }
    // }







    // public function updateMyProfile(Request $request)
    // {
    //     try {
    //         $validator = Validator::make($request->all(), [
    //             'name' => 'required|string|max:255',
    //             'city_id' => 'required|exists:cities,id',
    //             'card' => [
    //                 $request->isMethod('post') ? 'required' : 'nullable', 
    //                 'digits_between:1,14',
    //                 Rule::unique('clients', 'card')->ignore(auth('client_api')->user()->id),
    //             ],
    //             'image' => 'required',
    //             'imageprofile' => 'nullable',
    //             'paintscategories' => 'required|array',
    //             'paintscategories.*' => 'exists:paints_category,id',
    //         ], [
    //             'name.required' => 'اسم العميل مطلوب.',
    //             'name.string' => 'يجب أن يكون الاسم نصًا.',
    //             'city_id.required' => 'المدينة مطلوبة.',
    //             'card.required' => 'رقم البطاقة مطلوب.',
    //             'card.digits_between' => 'يجب أن يكون رقم البطاقة مكونًا من 1 إلى 14 رقمًا فقط.',
    //             'card.unique' => 'رقم البطاقة تم استخدامه من قبل.',
    //             'image.file' => 'يجب أن يكون الملف صورة صالحة.',
    //             'image.image' => 'يجب أن يكون الملف صورة (jpg, png, ...).',
    //             'image.max' => 'يجب ألا يزيد حجم الصورة عن 2 ميجا بايت.',
    //             'paintscategories.required' => 'يجب اختيار الفئات الخاصة بالدهانات.',
    //             'paintscategories.array' => 'يجب أن تكون الفئات عبارة عن مصفوفة.',
    //             'paintscategories.*.exists' => 'الفئة المحددة غير موجودة.',
    //         ]);

    //         if ($validator->fails()) {
    //             // dd($validator->errors());
    //             return $this->error_response($validator->errors()->first(), 422);
    //         }

    //         $client = auth('client_api')->user();

    //         $client->update([
    //             'name' => $request->name,
    //             'city_id' => $request->city_id,
    //             'card' => $request->card,
    //         ]);

    //         if ($request->hasFile('image')) {
    //             $client->clearMediaCollection('clients'); 
    //             $client->addMedia($request->file('image'))->toMediaCollection('clients');
    //         }

    //         if ($request->hasFile('imageprofile')) {
    //             $client->clearMediaCollection('clients_profile');
    //             $client->addMedia($request->file('imageprofile'))->toMediaCollection('clients_profile');
    //         }



    //         $client->paintscategories()->sync($request->paintscategories);

    //         // return $this->success_response ($client, 'تم تحديث معلومات العميل بنجاح');
    //         // $data = new ClientResource($client);

    //         return $this->success_response(

    //                  new ClientResource($client),
    //             'تم تحديث معلومات العميل بنجاح'
    //         );
    //     } catch (\Exception $e) {
    //         return $this->error_response('حدث خطأ غير متوقع', 500);
    //     }
    // }
    // public function updateMyProfile(Request $request)
    // {
    //     try {
    //         $client = auth('client_api')->user(); // العميل الحالي

    //         $validator = Validator::make($request->all(), [
    //             'name' => 'required|string|max:255',
    //             'city_id' => 'required|exists:cities,id',
    //             'card' => [
    //                 $client->card ? 'nullable' : 'required', // إذا كان لديه بطاقة بالفعل، اجعلها اختيارية
    //                 'digits_between:1,14',
    //                 Rule::unique('clients', 'card')->ignore($client->id), 
    //             ],
    //             'image' => 'required',
    //             'imageprofile' => 'nullable',
    //             'paintscategories' => 'required|array',
    //             'paintscategories.*' => 'exists:paints_category,id',
    //         ], [
    //             'name.required' => 'اسم العميل مطلوب.',
    //             'name.string' => 'يجب أن يكون الاسم نصًا.',
    //             'city_id.required' => 'المدينة مطلوبة.',
    //             'card.required' => 'رقم البطاقة مطلوب.',
    //             'card.digits_between' => 'يجب أن يكون رقم البطاقة مكونًا من 1 إلى 14 رقمًا فقط.',
    //             'card.unique' => 'رقم البطاقة تم استخدامه من قبل.',
    //             'image.file' => 'يجب أن يكون الملف صورة صالحة.',
    //             'image.image' => 'يجب أن يكون الملف صورة (jpg, png, ...).',
    //             'image.max' => 'يجب ألا يزيد حجم الصورة عن 2 ميجا بايت.',
    //             'paintscategories.required' => 'يجب اختيار الفئات الخاصة بالدهانات.',
    //             'paintscategories.array' => 'يجب أن تكون الفئات عبارة عن مصفوفة.',
    //             'paintscategories.*.exists' => 'الفئة المحددة غير موجودة.',
    //         ]);

    //         if ($validator->fails()) {
    //             return $this->error_response($validator->errors()->first(), 422);
    //         }

    //         $client->update([
    //             'name' => $request->name,
    //             'city_id' => $request->city_id,
    //             'card' => $request->card,
    //         ]);

    //         if ($request->hasFile('image')) {
    //             $client->clearMediaCollection('clients');
    //             $client->addMedia($request->file('image'))->toMediaCollection('clients');
    //         }

    //         if ($request->hasFile('imageprofile')) {
    //             $client->clearMediaCollection('clients_profile');
    //             $client->addMedia($request->file('imageprofile'))->toMediaCollection('clients_profile');
    //         }

    //         $client->paintscategories()->sync($request->paintscategories);

    //         return $this->success_response(
    //             new ClientResource($client),
    //             'تم تحديث معلومات العميل بنجاح'
    //         );
    //     } catch (\Exception $e) {
    //         return $this->error_response('حدث خطأ غير متوقع', 500);
    //     }
    // }





}
