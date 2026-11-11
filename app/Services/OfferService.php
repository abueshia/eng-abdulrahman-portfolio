<?php
namespace App\Services;

use App\Helpers\ReorderHelper;
use App\Models\Offer;
use Illuminate\Support\Arr;

class  OfferService {

    
    public function createOffer($data)
    {
        // dd($data);
        // إنشاء العرض
        $tourData = Arr::except($data, ['products' , 'branches']);
        $offer = Offer::create($tourData);

        // تخزين الصورة إذا كانت موجودة
        if (isset($data['image'])) {
            $offer->storeFile($data['image']);
        }

        // ربط العرض بالمنتجات (سواء منتج واحد أو مجموعة)
        if (isset($data['products'])) {
            $products = is_array($data['products']) ? $data['products'] : [$data['products']];
            $offer->products()->sync($products); // استخدم sync بدلاً من attach لتحديث الربط
        }

        // ربط العرض بالفروع (سواء فرع واحد أو مجموعة)
        if (isset($data['branches'])) {
            $branches = is_array($data['branches']) ? $data['branches'] : [$data['branches']];
            $offer->branches()->sync($branches); // استخدم sync بدلاً من attach لتحديث الربط
        }
        return $offer;
    }


    public function updateOffer($offer, $data)
    {
        $tourData = Arr::except($data, ['products', 'branches']);
        // تحديث بيانات العرض
        $offer->update($tourData);

        // تحديث الصورة إذا كانت موجودة
        if (isset($data['image'])) {
            $offer->updateFile($data['image']);
        }

        // إعادة ربط المنتجات (إزالة القديم وإضافة الجديد)
        if (isset($data['products']) && !empty($data['products'])) {
            $products = is_array($data['products']) ? $data['products'] : [$data['products']];
            $products = array_filter($products); // إزالة القيم الفارغة (null, '', 0)
            $offer->products()->sync($products);
        }

        // إعادة ربط الفروع (إزالة القديم وإضافة الجديد)
        if (isset($data['branches'])) {
            $branches = is_array($data['branches']) ? $data['branches'] : [$data['branches']];
            $offer->branches()->sync($branches);
        }

        return $offer;
    }





    public function deleteOffer($offer){
        $offer->delete();
    }


    public function reorder($offer, $label , $path, $max_num)
    {
        return ReorderHelper::reorder($offer, $label , $path, $max_num);
    }

    public function saveReorder ($all_entries, $offer)
    {
        return ReorderHelper::saveReorder($all_entries, $offer);
    }

}
