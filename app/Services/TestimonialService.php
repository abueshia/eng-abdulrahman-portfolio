<?php

namespace App\Services;

use App\Helpers\ReorderHelper;
use App\Models\Testimonial;

class  TestimonialService
{

    public function createTestimonial($data)
    {
     {
            $testimonial = Testimonial::create($data);
        if (isset($data['image'])) {
                $testimonial->storeFile($data['image']);
        }
    }
    }


    public function updateTestimonial($testimonial , $data)
    {
        if (isset($data['image'])) {
            $testimonial->updateFile($data['image']);
        }
        $testimonial->update($data);
    }


     public function deleteTestimonial($testimonial)
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
