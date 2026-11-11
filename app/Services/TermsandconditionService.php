<?php

namespace App\Services;

use App\Helpers\ReorderHelper;
use App\Models\Termsandcondition;

class  TermsandconditionService
{

    public function createTermsandcondition($data)
    {
     {
            $termsandcondition = Termsandcondition::create($data);
        if (isset($data['image'])) {
                $termsandcondition->storeFile($data['image']);
        }
    }
    }


    public function updateTermsandcondition($termsandcondition , $data)
    {
        if (isset($data['image'])) {
            $termsandcondition->updateFile($data['image']);
        }
        $termsandcondition->update($data);
    }


     public function deleteTermsandcondition($termsandcondition)
    {
        $termsandcondition->delete();
    }

    public function reorder($termsandcondition, $label, $path, $max_num)
    {
        return ReorderHelper::reorder($termsandcondition, $label, $path, $max_num);
    }

    public function saveReorder($all_entries, $termsandcondition)
    {
        return ReorderHelper::saveReorder($all_entries, $termsandcondition);
    }
}
