<?php

namespace App\Services;

use App\Helpers\ReorderHelper;
use App\Models\Privacypolicy;

class  PrivacypolicyService
{

    public function createPrivacypolicy($data)
    {
     {
            $testimonial = Privacypolicy::create($data);
        if (isset($data['image'])) {
                $testimonial->storeFile($data['image']);
        }
    }
    }


    public function updatePrivacypolicy($testimonial , $data)
    {
        if (isset($data['image'])) {
            $testimonial->updateFile($data['image']);
        }
        $testimonial->update($data);
    }


     public function deletePrivacypolicy($testimonial)
    {
        $testimonial->delete();
    }

    public function reorder($testimonial, $label, $path, $max_num)
    {
        return ReorderHelper::reorder($testimonial, $label, $path, $max_num);
    }

    public function saveReorder($all_entries, $testimonial)
    {
        return ReorderHelper::saveReorder($all_entries, $testimonial);
    }
}
