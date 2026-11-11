<?php

namespace App\Services;

use App\Helpers\ReorderHelper;
use App\Models\Voucherspage;

class  VoucherspageService
{

    public function createVoucherspage($data)
    {
     {
        // dd($data);
            $voucherspage = Voucherspage::create($data);
        }
        if (isset($data['meta_image'])) {
            $voucherspage->storeFile($data['meta_image'], '_meta_image');
        }
    }
 

    public function updateVoucherspage($voucherspage , $data)
    {
        if (isset($data['meta_image'])) {
            $voucherspage->updateFile($data['meta_image'], '_meta_image');
        }
        $voucherspage->update($data);
    }

     public function deleteVoucherspage($voucherspage)
    {
        $voucherspage->delete();
    }

    public function reorder($voucherspage, $label, $path, $max_num)
    {
        return ReorderHelper::reorder($voucherspage, $label, $path, $max_num);
    }

    public function saveReorder($all_entries, $voucherspage)
    {
        return ReorderHelper::saveReorder($all_entries, $voucherspage);
    }
}
