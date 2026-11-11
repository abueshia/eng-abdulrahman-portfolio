<?php

namespace App\Exports;

use App\Models\Coupon;

use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadings; // إضافة خاصية الرؤوس
use Maatwebsite\Excel\Concerns\ShouldAutoSize; // لتغيير حجم الأعمدة تلقائيًا

class CouponsExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $coupons;

    public function __construct($coupons)
    {
        $this->coupons = $coupons;
    }


    // public function collection()
    // {
    //     return Coupon::all();
    // }
    public function collection()
    {
        // ترتيب البيانات بحيث تطابق رؤوس الأعمدة
        return $this->coupons->map(function ($coupon) {
            return [
                'id' => $coupon->id,
                'code' => $coupon->code,
                'user_name' => $coupon->user ? $coupon->user->name : '-', // افترض وجود علاقة user
                'status' => $coupon->status ?? '-', // إذا كان هناك حالة للكوبون
                'created_at' => $coupon->created_at->format('Y-m-d H:i'),
            ];
        });
    }


    public function headings(): array
    {
        return [
            'ID',
            'Code',
            'User Name',
            'Code Status',
            'Date Created'
        ];
    }

}

