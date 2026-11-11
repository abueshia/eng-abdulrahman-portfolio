<?php

namespace App\Services;

use App\Helpers\ReorderHelper;
use App\Models\Paymentpicture;

class  PaymentpictureService
{

    public function createPaymentpicture($data)
    {
     {
            $paymentpicture = Paymentpicture::create($data);
        if (isset($data['image'])) {
                $paymentpicture->storeFile($data['image']);
        }
    }
    }


    public function updatePaymentpicture($paymentpicture , $data)
    {
        if (isset($data['image'])) {
            $paymentpicture->updateFile($data['image']);
        }
        $paymentpicture->update($data);
    }


     public function deletePaymentpicture($paymentpicture)
    {
        $paymentpicture->delete();
    }

    public function reorder($paymentpicture, $label, $path, $max_num)
    {
        return ReorderHelper::reorder($paymentpicture, $label, $path, $max_num);
    }

    public function saveReorder($all_entries, $paymentpicture)
    {
        return ReorderHelper::saveReorder($all_entries, $paymentpicture);
    }
}
