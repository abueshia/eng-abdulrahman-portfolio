<?php

namespace App\Services;

use App\Helpers\ReorderHelper;
use App\Models\Affgallery;

class  AffgalleryService
{


    public function createAffgallery($data)
    {
        // dd($data);
               $affgallery = Affgallery::create($data);

        if (isset($data['image'])) {
            $affgallery->storeFile($data['image']);
        }
    }

  public function updateAffgallery(Affgallery $affgallery, array $data)
{
    dd($data);
    {
        if (isset($data['image'])) {
                $affgallery->updateFile($data['image']);
        }
            $affgallery->update($data);
    }
}


    // {
    //     $gallery->update([
    //     ]);
    //     $this->updateFiles($gallery, $data);
    // }

    // private function updateFiles(Affgallery $gallery, array $data)
    // {
    //     if (isset($data['image'])) {
    //         $gallery->updateFile($data['image'], '_image');
    //     }
    // }

    public function deleteAffgallery(Affgallery $affgallery)
    {
        $affgallery->delete();
    }

    public function reorder($affgallery, $label, $path, $max_num)
    {
        return ReorderHelper::reorder($affgallery, $label, $path, $max_num);
    }

    public function saveReorder($all_entries, $affgallery)
    {
        return ReorderHelper::saveReorder($all_entries, $affgallery);
    }

}
