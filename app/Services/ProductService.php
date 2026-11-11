<?php

namespace App\Services;

use App\Helpers\ReorderHelper;
use App\Models\Product;

class  ProductService
{

    public function createProduct($data)
    {
     {
        // dd($data);
            $product = Product::create($data);
            // if (isset($data['image'])) {
            //         $product->storeFile($data['image']);
            // }
            if (isset($data['images'])) {
                foreach ($data['images'] as $image) {
                    $product->addMedia($image)->toMediaCollection('products');
                }
            }
    }
    }

    // public function updateProduct($product , $data)
    // {
    //     if (isset($data['image'])) {
    //         $product->updateFile($data['image']);
    //     }
    //     $product->update($data);
    // }

    public function updateProduct($product, $data)
    {
        if (isset($data['image'])) {
            $product->updateFile($data['image']); // تحديث الملف الرئيسي (صورة واحدة فقط)
        }

        // تحديث باقي بيانات المنتج
        $product->update($data);

        // التحقق من وجود صور جديدة
        if (isset($data['images'])) {
            // الخيار 1: حذف الصور القديمة واستبدالها بالجديدة
            // $product->clearMediaCollection('products');
            // foreach ($data['images'] as $image) {
            //     $product->addMedia($image)->toMediaCollection('products'); // إضافة الصور الجديدة
            // }

            // الخيار 2: إضافة الصور الجديدة مع الحفاظ على الصور القديمة
            foreach ($data['images'] as $image) {
                $product->addMedia($image)->toMediaCollection('products');
            }
        }
    }




     public function deleteProduct($product)
    {
        $product->delete();
    }

    public function reorder($product, $label, $path, $max_num)
    {
        return ReorderHelper::reorder($product, $label, $path, $max_num);
    }

    public function saveReorder($all_entries, $product)
    {
        return ReorderHelper::saveReorder($all_entries, $product);
    }
}
