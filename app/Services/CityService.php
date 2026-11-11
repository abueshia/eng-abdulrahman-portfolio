<?php
namespace App\Services;

use App\Helpers\ReorderHelper;
use App\Models\City;

class  CityService {

    public function createCity($data)
    {
        // dd($data);
//        if ($data['name'] && $data['name'] != null) {
//            $data['name'] = customizeSingleName($data['name']);
//        }
        $city = City::create($data);
        if (isset($data['image'])) {
            $city->storeFile($data['image']);
        }
    }

    public function updateCity($city , $data){
//        if ($data['name'] && $data['name'] != null) {
//            $data['name'] = customizeSingleName($data['name']);
//        }
        if(isset($data['image'])){
            $city->updateFile($data['image']);
        }
        $city->update($data);
    }

    public function deleteCity($city){
        $city->delete();
    }

    public function reorder($city, $label , $path, $max_num)
    {
        return ReorderHelper::reorder($city, $label , $path, $max_num);
    }

    public function saveReorder ($all_entries, $city)
    {
        return ReorderHelper::saveReorder($all_entries, $city);
    }



}
