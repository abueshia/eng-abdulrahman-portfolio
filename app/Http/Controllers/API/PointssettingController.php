<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserApp\ClientResource;
use App\Http\Resources\UserApp\CouponResource;
use App\Http\Resources\UserApp\PaginationCollection;
use App\Http\Resources\UserApp\PointssettingResource;
use App\Models\Client;
use App\Models\Coupon;
use App\Models\Otp;
use App\Models\Pointssetting;
use App\Models\Product;
use App\Models\Voucherspage;
// use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponseTrait;
use App\Traits\HandleUploadFile;
use Carbon\Carbon;
// use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PointssettingController extends Controller
{
    use ApiResponseTrait, HandleUploadFile;
    // use Illuminate\Support\Carbon;


    public function index(Request $request)
    {
        try {
            $Pointssetting = Pointssetting::paginate($request->limit ?? 15);
            $data = PointssettingResource::collection($Pointssetting);
            $pagination = new PaginationCollection($Pointssetting);
            return $this->success_response_with_pagination($data, 'Paint Pointssetting List', $pagination);
        } catch (\Exception $e) {
            return $this->error_response('Some Error Happened', 500);
        }
    }


// اضافة نقاط لدعوة صديق
    public function add_invite_friend(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'points' => 'required|numeric|min:1',
        ]);
        $client = Client::find($request->client_id);
        $client->points += $request->points;
        $client->save();
        return $this->success_response([], 'updated successfully.');
    }

  
// اضافة نقاط تسجيل جديد 
    public function add_points_new_registration(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'points' => 'required|numeric|min:1',
        ]);
        $client = Client::find($request->client_id);
        $client->points += $request->points;
        $client->save();
        return $this->success_response([], 'updated successfully.');
    }

// اضافة نقاط كود المنتج
    public function add_points_product_code(Request $request){
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'points' => 'required|numeric|min:1',
        ]);
        $client = Client::find($request->client_id);
        $client->points += $request->points;
        $client->save();
        return $this->success_response([], 'updated successfully.');
    }



public function add_coupon(Request $request)
{
    $request->validate([
        'client_id' => 'required|exists:clients,id',
         // 'product_id' => 'required_if:offer_id,null|exists:products,id', 
        'offer_id' => 'nullable|exists:offers,id', 
        'coupon_id' => 'required|string',
        'points' => 'nullable',
    ]);

    // البحث عن الكوبون
    $coupon = Coupon::where('code', $request->coupon_id)->first();

    if (!$coupon) {
        return response()->json([
            'message' => 'Invalid coupon code for the selected group.',
            'errors' => ['coupon_id' => ['The provided coupon code does not exist.']],
        ], 422);
    }

    // التحقق من استخدام الكوبون مسبقًا
    $used = Voucherspage::where('coupon_id', $coupon->id)->exists();

    if ($used) {
        return response()->json([
            'message' => 'Coupon already used.',
            'errors' => ['coupon_id' => ['The coupon has already been used.']],
        ], 422);
    }

    // التحقق من صلاحية الكوبون
    if (!$coupon->is_valid) {
        return response()->json([
            'message' => 'The coupon is invalid.',
            'errors' => ['coupon_id' => ['This coupon is marked as invalid.']],
        ], 422);
    }

    // التحقق من حظر الجروب أو انتهاء صلاحيته
    if ($coupon->group && ($coupon->group->is_banned || ($coupon->group->validate_to && Carbon::now()->gt(Carbon::parse($coupon->group->validate_to))))) {
        return response()->json([
            'message' => 'The coupon group is either banned or expired.',
            'errors' => ['group_id' => ['Invalid group for this coupon.']],
        ], 422);
    }



    // التحقق من وجود product_id
    // if (!$request->product_id) {
    //     return response()->json([
    //         'message' => 'Product ID is required when offer ID is not provided.',
    //         'errors' => ['product_id' => ['A valid product must be provided.']],
    //     ], 422);
    // }

    // البحث عن العرض المرتبط بالمنتج
    // $product = Product::find($request->product_id);
    // $offer = $product->offer;
     // Assuming a relation `offer` exists in the `Product` model

    //  dd($offer);

    // if (!$offer) {
    //     return response()->json([
    //         'message' => 'No offer found for the selected product.',
    //         'errors' => ['offer_id' => ['This product is not associated with any offer.']],
    //     ], 422);
    // }

    // جلب النقاط بناءً على إعدادات النقاط
    $points = Pointssetting::first();
    $points = $points ? $points->product_code : 0;

    // إنشاء سجل في جدول Voucherspage
    $voucherspage = Voucherspage::create([
        'client_id' => $request->client_id,
        'offer_id' => $coupon->product->offer_id ?? null,
        'product_id' => $coupon->product_id ?? null,
        'coupon_id' => $coupon->id,
        'points' => $points,
    ]);

    // استخدام المورد لإرجاع بيانات الكوبون
    $couponResource = new CouponResource($coupon);

    return $this->success_response($couponResource, 'Coupon added successfully.');
}



  
    // public function add_coupon(Request $request)
    // {
    //     $request->validate([
    //         'client_id' => 'required|exists:clients,id',
    //         'offer_id' => 'nullable|exists:offers,id',
    //         'product_id' => 'nullable|exists:products,id',
    //         'coupon_id' => 'required|string',
    //         // 'group_id' => 'required|exists:groups,id', 
    //         'points' => 'nullable',
    //     ]);

    //     // البحث عن الكوبون داخل المجموعة
    //     $coupon = Coupon::where('code', $request->coupon_id)
    //         // ->where('group_id', $request->group_id)
    //         ->first();

    //     if (!$coupon) {
    //         return response()->json([
    //             'message' => 'Invalid coupon code for the selected group.',
    //             'errors' => ['coupon_id' => ['The provided coupon code does not exist in this group.']],
    //         ], 422);
    //     }

    //     // التحقق من استخدام الكوبون مسبقًا
    //     $used = Voucherspage::where('coupon_id', $coupon->id)->exists();

    //     if ($used) {
    //         return response()->json([
    //             'message' => 'Coupon already used.',
    //             'errors' => ['coupon_id' => ['The coupon has already been used.']],
    //         ], 422);
    //     }

    //     // التحقق مما إذا كان الكوبون غير صالح
    //     if (!$coupon->is_valid) {
    //         return response()->json([
    //             'message' => 'The coupon is invalid.',
    //             'errors' => ['coupon_id' => ['This coupon is marked as invalid.']],
    //         ], 422);
    //     }

    //     // التحقق مما إذا كان الجروب محظورًا
    //     if ($coupon->group && $coupon->group->is_banned) {
    //         return response()->json([
    //             'message' => 'The coupon group is banned.',
    //             'errors' => ['group_id' => ['The group associated with this coupon is banned.']],
    //         ], 422);
    //     }

    //     // التحقق مما إذا كان تاريخ انتهاء الجروب قد تجاوز
    //     if ($coupon->group && $coupon->group->validate_to && Carbon::now()->gt(Carbon::parse($coupon->group->validate_to))) {
    //         return response()->json([
    //             'message' => 'The coupon has expired.',
    //             'errors' => ['group_id' => ['The group’s validity date has passed.']],
    //         ], 422);
    //     }

    //     // جلب قيمة النقاط من جدول إعدادات النقاط بناءً على product_code
    //     $points = Pointssetting::first();
    //     $points = $points ? $points->product_code : 0;

    //     $voucherspage = Voucherspage::create([
    //         'client_id' => $request->client_id,
    //         'offer_id' => $request->offer_id,
    //         'product_id' => $coupon->product_id,
    //         'coupon_id' => $coupon->id,
    //         'points' => $points,
    //     ]);

    //     // استخدام المورد لإرجاع بيانات الكوبون
    //     $couponResource = new CouponResource($coupon);

    //     return $this->success_response($couponResource, 'Coupon added successfully.');
    // }






}
