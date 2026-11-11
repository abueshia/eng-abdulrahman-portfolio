<?php

namespace App\Services;

use App\Helpers\ReorderHelper;
use App\Models\Coupon;

class  CouponService
{

    

    public function createCoupon($data)
    {
        // dd('$data');
        $numberOfCodes = $data['number']; 
        $codes = []; 

        $groupId = $data['group_id'] ?? null; 
        $productId = $data['product_id'] ?? null;

        for ($i = 0;
            $i < $numberOfCodes;
            $i++
        ) {
            do {
                $code = str_pad(mt_rand(0, 99999999), 8, '0', STR_PAD_LEFT); // كود من 8 أرقام
            } while (Coupon::where('code',
                $code
            )->exists()); // إذا كان الكود موجودًا، ننشئ واحدًا جديدًا

            $codes[] = [
                'code' => $code,
                'group_id' => $groupId,
                'product_id' => $productId == 'all' ? null : $productId, // تعيين `null` إذا كانت القيمة "all"
                'number' => $data['number'],
                'created_at' => now(),
                'updated_at' => now(),
            ]; 
        }

        Coupon::insert($codes);
    }





    public function updateCoupon($coupon , $data)
    {
        if (isset($data['image'])) {
            $coupon->updateFile($data['image']);
        }
        $coupon->update($data);
    }


     public function deleteCoupon($coupon)
    {
        $coupon->delete();
    }

    public function reorder($coupon, $label, $path, $max_num)
    {
        return ReorderHelper::reorder($coupon, $label, $path, $max_num);
    }

    public function saveReorder($all_entries, $coupon)
    {
        return ReorderHelper::saveReorder($all_entries, $coupon);
    }
}
