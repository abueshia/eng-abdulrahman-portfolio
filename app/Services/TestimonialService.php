<?php

declare(strict_types=1);

namespace App\Services;

use App\Helpers\ReorderHelper;
use App\Models\Testimonial;

class TestimonialService
{
    public function createTestimonial($data): void
    {

        $testimonial = Testimonial::create($data);
        if (isset($data['image'])) {
            $testimonial->storeFile($data['image']);
        }

    }

    public function updateTestimonial($testimonial, $data): void
    {
        if (isset($data['image'])) {
            $testimonial->updateFile($data['image']);
        }
        $testimonial->update($data);
    }

    public function deleteTestimonial($testimonial): void
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
