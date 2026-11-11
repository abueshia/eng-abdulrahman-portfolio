<?php
namespace App\Services;

use App\Helpers\ReorderHelper;
use App\Models\Region;

class  RegionService {

    public function createRegion($data)
    {
//        if ($data['name'] && $data['name'] != null) {
//            $data['name'] = customizeSingleName($data['name']);
//        }
        $region = Region::create($data);
        if (isset($data['image'])) {
            $region->storeFile($data['image']);
        }
    }

    public function updateRegion($region , $data){
//        if ($data['name'] && $data['name'] != null) {
//            $data['name'] = customizeSingleName($data['name']);
//        }
        if(isset($data['image'])){
            $region->updateFile($data['image']);
        }
        $region->update($data);
    }

    public function deleteRegion($region){
        $region->delete();
    }

    public function reorder($region, $label , $path, $max_num)
    {
        return ReorderHelper::reorder($region, $label , $path, $max_num);
    }

    public function saveReorder ($all_entries, $region)
    {
        return ReorderHelper::saveReorder($all_entries, $region);
    }



}
