<?php

namespace App\Services;

use App\Helpers\ReorderHelper;
use App\Models\Country;

class  CountryService
{

    public function createCountry($data)
    {
//        if ($data['name'] && $data['name'] != null) {
//            $data['name'] = customizeSingleName($data['name']);
//        }
        $country = Country::create($data);
        if (isset($data['image'])) {
            $country->storeFile($data['image']);
        }
    }

    public function updateCountry($country, $data)
    {
//        if ($data['name'] && $data['name'] != null) {
//            $data['name'] = customizeSingleName($data['name']);
//        }
        if (isset($data['image'])) {
            $country->updateFile($data['image']);
        }
        $country->update($data);
    }

    public function deleteCountry($country)
    {
        $country->delete();
    }

    public function reorder($country, $label, $path, $max_num)
    {
        return ReorderHelper::reorder($country, $label, $path, $max_num);
    }

    public function saveReorder($all_entries, $country)
    {
        return ReorderHelper::saveReorder($all_entries, $country);
    }


}
