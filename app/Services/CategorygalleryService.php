<?php
namespace App\Services;

use App\Helpers\ReorderHelper;
use App\Models\Categorygallery;

class  CategorygalleryService {

//     public function createCategorygallery($data)
//     {
//         $categorygallery = Categorygallery::create((array) $data);

//         if (isset($data['image'])) {
//             $categorygallery->storeFile($data['image']);
//         }
//     }

public function createCategorygallery(array $data)
{
    $categorygallery = Categorygallery::create([
        'name' => $data['name'] ?? null,
        'description' => $data['description'] ?? null,
       'meta_title' => $data['meta_title'] ?? null,
    ]);

    if (isset($data['image'])) {
        $categorygallery->storeFile($data['image']);
    }

    return $categorygallery;
}

    public function updateCategorygallery($categorygallery , $data)
    {

        if(isset($data['image'])){
            $categorygallery->updateFile($data['image']);
        }
        $categorygallery->update($data);
    }

    public function deleteCategorygallery($categorygallery){
        $categorygallery->delete();
    }

    public function reorder($categorygallery, $label , $path, $max_num)
    {
        return ReorderHelper::reorder($categorygallery, $label , $path, $max_num);
    }

    public function saveReorder ($all_entries, $categorygallery)
    {
        return ReorderHelper::saveReorder($all_entries, $categorygallery);
    }



}

