<?php

namespace App\Services;

use App\Helpers\ReorderHelper;
use App\Models\Productcategory;

class  ProductcategoryService
{

    public function createProductcategory($data)
    {
     {
        // dd($data);
            $productcategory = Productcategory::create($data);
        }
        if (isset($data['meta_image'])) {
            $productcategory->storeFile($data['meta_image'], '_meta_image');
        }
    }
 

    public function updateProductcategory($productcategory , $data)
    {
        if (isset($data['meta_image'])) {
            $productcategory->updateFile($data['meta_image'], '_meta_image');
        }
        $productcategory->update($data);
    }

     public function deleteProductcategory($productcategory)
    {
        $productcategory->delete();
    }

    public function reorder($productcategory, $label, $path, $max_num)
    {
        return ReorderHelper::reorder($productcategory, $label, $path, $max_num);
    }

    public function saveReorder($all_entries, $productcategory)
    {
        return ReorderHelper::saveReorder($all_entries, $productcategory);
    }
}
