<?php

namespace App\Services;

use App\Helpers\ReorderHelper;
use App\Models\Paintscategory;

class  PaintscategoryService
{

    public function createPaintscategory($data)
    {
     {
        // dd($data);
            $paintscategory = Paintscategory::create($data);
        }
        // if (isset($data['meta_image'])) {
        //     $paintscategory->storeFile($data['meta_image'], '_meta_image');
        // }
          if (isset($data['image'])) {
            $paintscategory->storeFile($data['image']);
            }
    }
 

    public function updatePaintscategory($paintscategory , $data)
    {

        if (isset($data['image'])) {
            $paintscategory->updateFile($data['image']);
        }

        if (isset($data['meta_image'])) {
            $paintscategory->updateFile($data['meta_image'], '_meta_image');
        }

        $paintscategory->update($data);
    }

     public function deletePaintscategory($paintscategory)
    {
        $paintscategory->delete();
    }

    public function reorder($paintscategory, $label, $path, $max_num)
    {
        return ReorderHelper::reorder($paintscategory, $label, $path, $max_num);
    }

    public function saveReorder($all_entries, $paintscategory)
    {
        return ReorderHelper::saveReorder($all_entries, $paintscategory);
    }
}
