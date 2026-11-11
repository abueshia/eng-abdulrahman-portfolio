<?php

namespace App\Services;

use App\Helpers\ReorderHelper;
use App\Models\Branche;

class  BrancheService
{

    public function createBranche($data)
    {
     {
        // dd($data);
            $branche = Branche::create($data);
        if (isset($data['image'])) {
                $branche->storeFile($data['image']);
        }
    }
    }


    public function updateBranche($branche , $data)
    {
        if (isset($data['image'])) {
            $branche->updateFile($data['image']);
        }
        $branche->update($data);
    }


     public function deleteBranche($branche)
    {
        $branche->delete();
    }

    public function reorder($branche, $label, $path, $max_num)
    {
        return ReorderHelper::reorder($branche, $label, $path, $max_num);
    }

    public function saveReorder($all_entries, $branche)
    {
        return ReorderHelper::saveReorder($all_entries, $branche);
    }
}
