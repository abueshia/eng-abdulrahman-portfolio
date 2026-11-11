<?php

namespace App\Services;

use App\Helpers\ReorderHelper;
use App\Models\Pointssetting;

class  PointssettingService
{

    public function createPointssetting($data)
    {
     {
        // dd($data);
            $pointssetting = Pointssetting::create($data);
        }
        if (isset($data['meta_image'])) {
            $pointssetting->storeFile($data['meta_image'], '_meta_image');
        }
    }
 

    public function updatePointssetting($pointssetting , $data)
    {
        if (isset($data['meta_image'])) {
            $pointssetting->updateFile($data['meta_image'], '_meta_image');
        }
        $pointssetting->update($data);
    }

     public function deletePointssetting($pointssetting)
    {
        $pointssetting->delete();
    }

    public function reorder($pointssetting, $label, $path, $max_num)
    {
        return ReorderHelper::reorder($pointssetting, $label, $path, $max_num);
    }

    public function saveReorder($all_entries, $pointssetting)
    {
        return ReorderHelper::saveReorder($all_entries, $pointssetting);
    }
}
