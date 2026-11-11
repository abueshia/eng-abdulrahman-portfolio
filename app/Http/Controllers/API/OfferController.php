<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserApp\BranchesResource;
use App\Http\Resources\UserApp\CityResource;
use App\Http\Resources\UserApp\OfferResource;
use App\Http\Resources\UserApp\PaginationCollection;
use App\Http\Resources\UserApp\VouchercodeofferResource;
use App\Models\Branche;
use App\Models\City;
use App\Models\Client;
use App\Models\Coupon;
use App\Models\Offer;
use App\Models\Pointssetting;
use App\Models\Vouchercodeoffer;
use App\Models\Voucherspage;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class OfferController extends Controller
{


    use ApiResponseTrait;


    public function index(Request $request)
    {
        try {
            // ترتيب حسب الأحدث
            $offer = Offer::with('products')
            ->orderBy('created_at', 'DESC')
            ->paginate($request->limit ?? 15);

            $data = OfferResource::collection($offer);
            $pagination = new PaginationCollection($offer);

            return $this->success_response_with_pagination($data, 'Offer List', $pagination);
        } catch (\Exception $e) {
            return $this->error_response('Some Error Happened', 500);
        }
    }

    public function AddCodeOffer(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'offer_id' => 'required|exists:offers,id',
            'discount_number' => 'required|string',
        ]);

        // جلب البيانات من الطلب
        $clientId = $request->client_id;
        $offerId = $request->offer_id;
        $discountNumber = $request->discount_number;

        // جلب العرض والعميل بناءً على الـ ID
        $offer = Offer::find($offerId);
        $client = Client::find($clientId);

        // تحقق أولاً إذا كان الكود موجودًا في جدول الكوبونات
        $coupon = Coupon::where('code', $discountNumber)->first();
        if ($coupon) {
            // التحقق من استخدام الكوبون مسبقًا
            $used = Voucherspage::where('coupon_id', $coupon->id)->exists();
            if ($used) {
                return response()->json([
                    'success' => false,
                    'message' => 'This coupon has already been used.',
                ], 400);
            }

            // التحقق مما إذا كان الكوبون غير صالح
            if (!$coupon->is_valid) {
                return response()->json([
                    'success' => false,
                    'message' => 'The coupon is invalid.',
                ], 400);
            }

            // جلب قيمة النقاط من جدول إعدادات النقاط
            $pointsSetting = Pointssetting::first();
            $pointsToAdd = $pointsSetting ? $pointsSetting->product_code : 0;

            // إضافة النقاط لحساب العميل
            $client->points += $pointsToAdd;
            $client->save();

            // تسجيل الكوبون كـ مستخدم
            Voucherspage::create([
                'client_id' => $clientId,
                'coupon_id' => $coupon->id,
                'points' => $pointsToAdd,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Coupon applied successfully. Points added to client account.',
            ], 200);
        }

        // تحقق إذا كان الكود تابعًا للعرض
        if ($offer->discount_number !== $discountNumber) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid discount code for this offer.',
            ], 400);
        }

        // التحقق من أن العميل لم يستخدم الكود لهذا العرض من قبل
        $existingEntry = Vouchercodeoffer::where('client_id', $clientId)
            ->where('offer_id', $offerId)
            ->first();

        if ($existingEntry) {
            return response()->json([
                'success' => false,
                'message' => 'This code has already been used for this offer by the client.',
            ], 400);
        }

        // التحقق من أن نقاط العميل كافية لتطبيق العرض
        if ($client->points < $offer->point) {
            return response()->json([
                'success' => false,
                'message' => 'Insufficient points to apply this offer.',
            ], 400);
        }

        // خصم نقاط العرض من نقاط العميل
        $client->points -= $offer->point;
        $client->save();

        // إضافة البيانات إلى جدول voucher_code_offer مع نقاط العرض
        $voucherCodeOffer = Vouchercodeoffer::create([
            'client_id' => $clientId,
            'offer_id' => $offerId,
            'discount_number' => $discountNumber,
            'points' => $offer->point, // نقاط العرض
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Offer applied successfully. Points deducted from client.',
            'data' => $voucherCodeOffer,
        ],
            200
        );
    }



    // public function AddCodeOffer(Request $request)
    // {
    //     $request->validate([
    //         'client_id' => 'required|exists:clients,id',
    //         'offer_id' => 'required|exists:offers,id',
    //         'discount_number' => 'required|string',
    //     ]);

    //     // جلب البيانات من الطلب
    //     $clientId = $request->client_id;
    //     $offerId = $request->offer_id;
    //     $discountNumber = $request->discount_number;

    //     // جلب العرض والعميل بناءً على الـ ID
    //     $offer = Offer::find($offerId);
    //     $client = Client::find($clientId);

    //     // التحقق من أن الكود يتبع العرض
    //     if ($offer->discount_number !== $discountNumber) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Invalid discount code for this offer.',
    //         ], 400);
    //     }

    //     // التحقق من أن العميل لم يستخدم الكود لهذا العرض من قبل
    //     $existingEntry = Vouchercodeoffer::where('client_id', $clientId)
    //         ->where('offer_id', $offerId)
    //         ->first();

    //     if ($existingEntry) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'This code has already been used for this offer by the client.',
    //         ], 400);
    //     }

    //     // التحقق من أن نقاط العميل كافية لتطبيق العرض
    //     if ($client->points < $offer->point) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Insufficient points to apply this offer.',
    //         ], 400);
    //     }

    //     // خصم نقاط العرض من نقاط العميل
    //     $client->points -= $offer->point;
    //     $client->save();

    //     // إضافة البيانات إلى جدول voucher_code_offer مع نقاط العرض
    //     $voucherCodeOffer = Vouchercodeoffer::create([
    //         'client_id' => $clientId,
    //         'offer_id' => $offerId,
    //         'discount_number' => $discountNumber,
    //         'points' => $offer->point, // نقاط العرض
    //     ]);

    //     // إرجاع استجابة النجاح
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Offer applied successfully. Points deducted from client.',
    //         'data' => $voucherCodeOffer,
    //     ],
    //         200
    //     );
    // }




















    

    // public function AddCodeOffer(Request $request)
    // {
    //     $request->validate([
    //         'client_id' => 'required|exists:clients,id',
    //         'offer_id' => 'required|exists:offers,id',
    //         'discount_number' => 'required|string',
    //     ]);

    //     // جلب البيانات من الطلب
    //     $clientId = $request->client_id;
    //     $offerId = $request->offer_id;
    //     $discountNumber = $request->discount_number;

    //     // جلب العرض والعميل بناءً على الـ ID
    //     $offer = Offer::find($offerId);
    //     $client = Client::find($clientId);

    //     // التحقق من أن الكود يتبع العرض
    //     if ($offer->discount_number !== $discountNumber) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Invalid discount code for this offer.',
    //         ], 400);
    //     }

    //     // التحقق من أن العميل لم يستخدم الكود لهذا العرض من قبل
    //     $existingEntry = Vouchercodeoffer::where('client_id', $clientId)
    //         ->where('offer_id', $offerId)
    //         ->first();

    //     if ($existingEntry) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'This code has already been used for this offer by the client.',
    //         ], 400);
    //     }

    //     // إضافة البيانات إلى جدول voucher_code_offer مع نقاط العرض
    //     $voucherCodeOffer = Vouchercodeoffer::create([
    //         'client_id' => $clientId,
    //         'offer_id' => $offerId,
    //         'discount_number' => $discountNumber,
    //         'points' => $offer->point, // نقاط العرض
    //     ]);

    //     // تحديث نقاط العميل
    //     $client->points += $offer->point;
    //     $client->save();

    //     // إرجاع استجابة النجاح
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Offer applied successfully.',
    //         'data' => $voucherCodeOffer,
    //     ], 200);
    // }



   


    public function CodeOperations(Request $request)
    {
        try {
            $Vouchercodeoffer = Vouchercodeoffer::paginate($request->limit ?? 15);
            $data = VouchercodeofferResource::collection($Vouchercodeoffer);
            $pagination = new PaginationCollection($Vouchercodeoffer);
            return $this->success_response_with_pagination($data, 'Vouchercodeoffer List', $pagination);
        } catch (\Exception $e) {
            return $this->error_response('Some Error Happened', 500);
        }
    }

    
}
