<?php
namespace App\Services;

use App\Helpers\ReorderHelper;
use App\Models\Banner;

class  BannerService{


    public function createBanner($data)
    {
        $banner = Banner::create([
            'title' => $data['title'],
            'description' => $data['description'],
        ]);

        if (isset($data['before_image'])) {
            $banner->addMedia($data['before_image'])->toMediaCollection('before_image');
        }

        if (isset($data['after_image'])) {
            $banner->addMedia($data['after_image'])->toMediaCollection('after_image');
        }

        return $banner;
    }

    public function updateBanner($banner, $data)
    {
        if (isset($data['before_image'])) {
            $banner->clearMediaCollection('before_image');
            $banner->addMedia($data['before_image'])->toMediaCollection('before_image');
        }

        if (isset($data['after_image'])) {
            $banner->clearMediaCollection('after_image');
            $banner->addMedia($data['after_image'])->toMediaCollection('after_image');
        }

        $banner->update([
            'title' => $data['title'],
            'description' => $data['description'],
        ]);

        return $banner;
    }


    // Old code removed to avoid redeclaration
    public function deleteBanner($banner){
        $banner->delete();
    }


   

    public function reorder($banner, $label , $path, $max_num)
    {
        return ReorderHelper::reorder($banner, $label , $path, $max_num);
    }

    public function saveReorder ($all_entries, $banner)
    {
        return ReorderHelper::saveReorder($all_entries, $banner);
    }



}
