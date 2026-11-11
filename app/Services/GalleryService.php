<?php
namespace App\Services;

use App\Helpers\ReorderHelper;
use App\Models\Gallery;

class GalleryService {
    

    public function createGallery($data)
    {
        $gallery = Gallery::create([
         
            // 'categorygallery_id' => $data['categorygallery_id'],
        ]);
        $this->storeFiles($gallery, $data);
    }


    public function updateGallery(Gallery $gallery, array $data)
    {
        $gallery->update([
            // 'categorygallery_id' => $data['categorygallery_id'],
        ]);
        $this->updateFiles($gallery, $data);
    }



    public function deleteGallery(Gallery $gallery)
    {
        $gallery->delete();
    }

    private function storeFiles(Gallery $gallery, array $data)
    {
        if (isset($data['image'])) {
            $gallery->storeFile($data['image'], '_image');
        }
    }


    private function updateFiles(Gallery $gallery, array $data)
    {
        if (isset($data['image'])) {
            $gallery->updateFile($data['image'], '_image');
        }
    }

    public function reorder($gallery, $label, $path, $max_num)
    {
        return ReorderHelper::reorder($gallery, $label, $path, $max_num);
    }

    public function saveReorder($all_entries, $gallery)
    {
        return ReorderHelper::saveReorder($all_entries, $gallery);

}
    }