<?php

namespace App\Services;

use App\Helpers\ReorderHelper;
use App\Models\Complaint;

class  ComplaintService
{

    public function createComplaint($data)
    {
     {
        // dd($data);
            $complaint = Complaint::create($data);
        }
        if (isset($data['meta_image'])) {
            $complaint->storeFile($data['meta_image'], '_meta_image');
        }
    }
 

    public function updateComplaint($complaint , $data)
    {
        if (isset($data['meta_image'])) {
            $complaint->updateFile($data['meta_image'], '_meta_image');
        }
        $complaint->update($data);
    }

     public function deleteComplaint($complaint)
    {
        $complaint->delete();
    }

    public function reorder($complaint, $label, $path, $max_num)
    {
        return ReorderHelper::reorder($complaint, $label, $path, $max_num);
    }

    public function saveReorder($all_entries, $complaint)
    {
        return ReorderHelper::saveReorder($all_entries, $complaint);
    }
}
