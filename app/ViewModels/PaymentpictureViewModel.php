<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use App\Models\Paymentpicture;

class PaymentpictureViewModel extends ViewModel
{
    public function __construct(public ?Paymentpicture $paymentpicture = null)
    {
        $this->paymentpicture = is_null($paymentpicture) ? new Paymentpicture(old()) : $paymentpicture;
    }

    public function action(): string
    {
        return is_null($this->paymentpicture->id)
            ? route('admin.paymentpicture.store')
            : route('admin.paymentpicture.update', ['paymentpicture' => $this->paymentpicture->id]);
    }

    public function method(): string
    {
        return is_null($this->paymentpicture->id) ? 'POST' : 'PUT';
    }
}
