<?php
namespace App\Services;

use App\Helpers\ReorderHelper;
use App\Models\BottomBanner;

class  BottomBannerService{

    public function createBottomBanner($data)
    {
        $bottom_banner = BottomBanner::create($data);
        if (isset($data['image'])) {
            $bottom_banner->storeFile($data['image']);
        }
    }

    public function updateBottomBanner($bottom_banner , $data){
        if(isset($data['image'])){
            $bottom_banner->updateFile($data['image']);
        }
        $bottom_banner->update($data);
    }

    public function deleteBottomBanner($bottom_banner){
        $bottom_banner->delete();
    }




}
