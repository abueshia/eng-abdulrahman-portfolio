<?php

namespace App\Services;

use App\Helpers\ReorderHelper;
use App\Models\Informationflight;

class  InformationflightService
{

    public function createInformationflight($data)
    {
     {
            $informationflight = Informationflight::create($data);
        if (isset($data['image'])) {
                $informationflight->storeFile($data['image']);
        }
    }
    }


    public function updateInformationflight($informationflight , $data)
    {
        if (isset($data['image'])) {
            $informationflight->updateFile($data['image']);
        }
        $informationflight->update($data);
    }


     public function deleteInformationflight($informationflight)
    {
        $informationflight->delete();
    }

    public function reorder($informationflight, $label, $path, $max_num)
    {
        return ReorderHelper::reorder($informationflight, $label, $path, $max_num);
    }

    public function saveReorder($all_entries, $informationflight)
    {
        return ReorderHelper::saveReorder($all_entries, $informationflight);
    }
}
