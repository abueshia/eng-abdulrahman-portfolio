<?php

namespace App\Services;

use App\Helpers\ReorderHelper;
use App\Models\Informationhotel;

class  InformationhotelService
{

    public function createInformationhotel($data)
    {
     {
            $informationhotel = Informationhotel::create($data);
        if (isset($data['image'])) {
                $informationhotel->storeFile($data['image']);
        }
    }
    }

    public function updateInformationhotel($informationhotel , $data)
    {
        if (isset($data['image'])) {
            $informationhotel->updateFile($data['image']);
        }
        $informationhotel->update($data);
    }


     public function deleteInformationhotel($informationhotel)
    {
        $informationhotel->delete();
    }

    public function reorder($informationhotel, $label, $path, $max_num)
    {
        return ReorderHelper::reorder($informationhotel, $label, $path, $max_num);
    }

    public function saveReorder($all_entries, $informationhotel)
    {
        return ReorderHelper::saveReorder($all_entries, $informationhotel);
    }
}
