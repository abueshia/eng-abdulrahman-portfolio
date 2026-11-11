<?php

namespace App\Services;

use App\Helpers\ReorderHelper;
use App\Models\Informationtour;

class  InformationtourService
{

    public function createInformationtour($data)
    {
     {
            $informationtour = Informationtour::create($data);
        if (isset($data['image'])) {
                $informationtour->storeFile($data['image']);
        }
    }
    }


    public function updateInformationtour($informationtour , $data)
    {
        if (isset($data['image'])) {
            $informationtour->updateFile($data['image']);
        }
        $informationtour->update($data);
    }


     public function deleteInformationtour($informationtour)
    {
        $informationtour->delete();
    }

    public function reorder($informationtour, $label, $path, $max_num)
    {
        return ReorderHelper::reorder($informationtour, $label, $path, $max_num);
    }

    public function saveReorder($all_entries, $informationtour)
    {
        return ReorderHelper::saveReorder($all_entries, $informationtour);
    }
}
