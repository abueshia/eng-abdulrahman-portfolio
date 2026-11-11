<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use App\Models\Coupon;

class CouponViewModel extends ViewModel
{
    public function __construct(public ?Coupon $coupon = null)
    {
        $this->coupon = is_null($coupon) ? new Coupon(old()) : $coupon;
    }

    public function action(): string
    {
        return is_null($this->coupon->id)
            ? route('admin.coupon.store')
            : route('admin.coupon.update', ['coupon' => $this->coupon->id]);
    }

    public function method(): string
    {
        return is_null($this->coupon->id) ? 'POST' : 'PUT';
    }
}
