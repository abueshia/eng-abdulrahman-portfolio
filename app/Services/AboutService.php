<?php

namespace App\Services;

use App\Helpers\ReorderHelper;
use App\Models\About;

class  AboutService
{

    public function createAbout($data)
    {
     {
        // dd($data);
            $about = About::create($data);
        }
        // if (isset($data['image'])) {
        //     $data->storeFile($data['image']);
        // }
        if (isset($data['meta_image'])) {
            $about->storeFile($data['meta_image'], '_meta_image');
        }
    }



    // public function updateAbout($about, $data)
    // {
    //     $about->update($data);
    //     $this->updateFiles($about, $data);
    // }

    // private function updateFiles(About $about, array $data)
    // {
    //     if (isset($data['image'])) {
    //         $about->addMedia($data['image'])->toMediaCollection('abouts');
    //     }

    //     if (isset($data['meta_image'])) {
    //         $about->addMedia($data['meta_image'])->toMediaCollection('meta_images');
    //     }
    // }



    public function updateAbout($about, $data)
    {
        $about->update($data);
       $this->updateFiles($about, $data);
    }


    private function updateFiles(About $about, array $data)
    {
        if (isset($data['image'])) {
            $about->updateFile($data['image'], '_image');
        }
        if (isset($data['meta_image'])) {
            $about->updateFile($data['meta_image'], '_meta_image');
        }
    }




     public function deleteAbout($about)
    {
        $about->delete();
    }

    public function reorder($about, $label, $path, $max_num)
    {
        return ReorderHelper::reorder($about, $label, $path, $max_num);
    }

    public function saveReorder($all_entries, $about)
    {
        return ReorderHelper::saveReorder($all_entries, $about);
    }
}
