<?php
namespace App\Services;

use App\Helpers\ReorderHelper;
use App\Models\Category;

class  CategoryService {

    public function createCategory($data)
    {
        // $data['slug'] = $this->createUniqueSlug($data['name'], Category::class);

        $category = Category::create($data);

        if (isset($data['image'])) {
            $category->storeFile($data['image']);
        }
        if (isset($data['meta_image'])) {
            $category->storeFile($data['meta_image'], '_meta_image');
        }
    }

//     public function createUniqueSlug($name, $model , $id = null) {
//         $slug = $this->generateArabicSlug($name);

//         $originalSlug = $slug;

//         // Keep modifying the slug by appending a number until it's unique
//         if ($id != null) {
//             $count = $model::where('slug', $slug)->where('id', '!=', $id)->count();
//         } else {
//             $count = $model::where('slug', $slug)->count();

//         }
//         if ($count > 0) {
//             $slug = $originalSlug . '-' . $count;
//         } else {
//             $slug = $originalSlug;
//         }
// //        dd($slug);
//         return $slug;


//     }
//     public function generateArabicSlug($string, $separator = '-')
//     {
//         if (is_null($string)) {
//             return "";
//         }

//         $string = trim($string);

//         $string = mb_strtolower($string, "UTF-8");;

//         $string = preg_replace("/[^a-z0-9_\sءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]#u/", "", $string);

//         $string = preg_replace("/[\s-]+/", " ", $string);

//         $string = preg_replace("/[\s_]/", $separator, $string);

//         return $string;
//     }

    public function updateCategory($category , $data)
    {

        // $data['slug'] = $this->createUniqueSlug($data['name'], Category::class, $category->id);

        if(isset($data['image'])){
            $category->updateFile($data['image']);
        }
        if (isset($data['meta_image'])) {
            $category->updateFile($data['meta_image'], '_meta_image');
        }
        $category->update($data);
    }

    public function deleteCategory($category){
        $category->delete();
    }

    public function reorder($category, $label , $path, $max_num)
    {
        return ReorderHelper::reorder($category, $label , $path, $max_num);
    }

    public function saveReorder ($all_entries, $category)
    {
        return ReorderHelper::saveReorder($all_entries, $category);
    }

}
