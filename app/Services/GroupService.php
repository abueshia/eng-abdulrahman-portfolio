<?php

namespace App\Services;

use App\Helpers\ReorderHelper;
use App\Models\Group;

class  GroupService
{

    public function createGroup($data)
    {
     {
        // dd($data);
            $group = Group::create($data);
        }
        if (isset($data['meta_image'])) {
            $group->storeFile($data['meta_image'], '_meta_image');
        }
    }
 

    public function updateGroup($group , $data)
    {
        if (isset($data['meta_image'])) {
            $group->updateFile($data['meta_image'], '_meta_image');
        }
        $group->update($data);
    }

     public function deleteGroup($group)
    {
        $group->delete();
    }

    public function reorder($group, $label, $path, $max_num)
    {
        return ReorderHelper::reorder($group, $label, $path, $max_num);
    }

    public function saveReorder($all_entries, $group)
    {
        return ReorderHelper::saveReorder($all_entries, $group);
    }
}
