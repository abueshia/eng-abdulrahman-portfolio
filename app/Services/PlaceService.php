<?php
namespace App\Services;

use App\Helpers\ReorderHelper;
use App\Models\Place;

class  PlaceService {



    public function createPlace($data)
    {
        // $data['slug_ar'] = isset($data['title_ar']) ? $this->createUniqueSlug($data['title_ar'], Place::class) : null;
        // $data['slug_en'] = isset($data['title_en']) ? $this->createUniqueSlug($data['title_en'], Place::class) : null;
        // $slug = [
        //     'en' => isset($data['name_en']) ? \Illuminate\Support\Str::slug($data['name_en']) : '',
        //     'sa' => isset($data['name_ar']) ? $this->generateArabicSlug($data['name_ar']) : '',
        // ];
        // $data['slug'] = json_encode($slug);

        $place = Place::create($data);

        if (isset($data['image'])) {
            $place->storeFile($data['image']);
        }
        // if (isset($data['meta_image'])) {
        //     $place->storeFile($data['meta_image'], '_meta_image');
        // }
    }

    // public function createUniqueSlug($title, $modelClass)
    // {
    //     $slug = $this->generateArabicSlug($title);
    //     $count = 1;
    //     while ($modelClass::where('slug', $slug)->exists()) {
    //         $slug = $this->generateArabicSlug($title) . '-' . $count;
    //         $count++;
    //     }
    //     return $slug;
    // }

    // public function generateArabicSlug($string, $separator = '-')
    // {
    //     if (is_null($string)) {
    //         return "";
    //     }

    //     $string = trim($string);

    //     $string = mb_strtolower($string, "UTF-8");;

    //     $string = preg_replace("/[^a-z0-9_\sءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]#u/", "", $string);

    //     $string = preg_replace("/[\s-]+/", " ", $string);

    //     $string = preg_replace("/[\s_]/", $separator, $string);

    //     return $string;
    // }

    public function updatePlace($place , $data){


        //         $slug = [
        //     'en' => isset($data['name_en']) ? \Illuminate\Support\Str::slug($data['name_en']) : '',
        //     'sa' => isset($data['name_ar']) ? $this->generateArabicSlug($data['name_ar']) : '',
        // ];
        // $data['slug'] = json_encode($slug);

        if(isset($data['image'])){
            $place->updateFile($data['image']);
        }
        // if (isset($data['meta_image'])) {
        //     $place->updateFile($data['meta_image'], '_meta_image');
        // }
        $place->update($data);
    }

    public function deletePlace($place){
        $place->delete();
    }

    public function reorder($place, $label , $path, $max_num)
    {
        return ReorderHelper::reorder($place, $label , $path, $max_num);
    }

    public function saveReorder ($all_entries, $place)
    {
        return ReorderHelper::saveReorder($all_entries, $place);
    }

}
