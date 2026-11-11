<?php
namespace App\Services;

use App\Helpers\ReorderHelper;
use App\Models\Placecat;

class  PlacecatService {

    public function createPlacecat(array $data): Placecat
    {
        return Placecat::create($data);
    }


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

    public function updatePlacecat($placecat , $data){

        // $slug = [
        //     'en' => isset($data['name_en']) ? \Illuminate\Support\Str::slug($data['name_en']) : '',
        //     'sa' => isset($data['name_ar']) ? $this->generateArabicSlug($data['name_ar']) : '',
        // ];
        // $data['slug'] = json_encode($slug);

        $placecat->update($data);
    }



    public function deletePlacecat($placecat){
        $placecat->delete();
    }

    public function reorder($placecat, $label , $path, $max_num)
    {
        return ReorderHelper::reorder($placecat, $label , $path, $max_num);
    }

    public function saveReorder ($all_entries, $placecat)
    {
        return ReorderHelper::saveReorder($all_entries, $placecat);
    }



}
