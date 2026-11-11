<?php
namespace App\Services;

use App\Helpers\ReorderHelper;
use App\Models\Categorycolid;

class  CategorycolidService {

    public function createCategorycolid($data)
    {

        $categorycolid = Categorycolid::create($data);

        if (isset($data['image'])) {
            $categorycolid->storeFile($data['image']);
        }
        if (isset($data['meta_image'])) {
            $categorycolid->storeFile($data['meta_image'], '_meta_image');
        }
    }

    public function updateCategorycolid($categorycolid , $data)
    {

        if(isset($data['image'])){
            $categorycolid->updateFile($data['image']);
        }
        if (isset($data['meta_image'])) {
            $categorycolid->updateFile($data['meta_image'], '_meta_image');
        }
        $categorycolid->update($data);
    }

    public function deleteCategorycolid($categorycolid){
        $categorycolid->delete();
    }

    public function reorder($categorycolid, $label , $path, $max_num)
    {
        return ReorderHelper::reorder($categorycolid, $label , $path, $max_num);
    }

    public function saveReorder ($all_entries, $categorycolid)
    {
        return ReorderHelper::saveReorder($all_entries, $categorycolid);
    }

}
