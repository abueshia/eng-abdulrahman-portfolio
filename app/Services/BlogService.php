<?php

namespace App\Services;

use App\Helpers\ReorderHelper;
use App\Models\Blog;
use App\Models\Tag;

class  BlogService
{

    public function createBlog($data)
    {
        $blog = Blog::create([
            'name' => $data['name'],
            'description' => $data['description'],
            // 'slug' => $this->createUniqueSlug($data['name'], Blog::class),
            // 'meta_description' => $data['meta_description'],
            // 'meta_title' => $data['meta_title'],
            // 'alt_text' => $data['alt_text'],
            // 'category_id' => $data['category_id'],
        ]);

        $this->storeFiles($blog, $data);
        // if (isset($data['meta_tags']) && $data['meta_tags'] != null) {
        //     $tags = $data['meta_tags'];
        //     $new_tags = [];
        //     foreach ($tags as $tag) {
        //         $check = Tag::where('id', $tag)->orWhere('name', $tag)->first();
        //         if ($check) {
        //             $new_tags[] = $check->id;
        //         } else {
        //             $new_tag = Tag::create([
        //                 'name' => $tag,
        //                 'slug' => $this->createUniqueSlug($tag, Tag::class)
        //             ]);
        //             $new_tags[] = $new_tag->id;
        //         }
        //     }
        //     $blog->tags()->sync($new_tags);
        //     $meta_tags = $blog->tags()->pluck('name')->toArray();
        //     $meta_tags = implode(',', $meta_tags);
        //     $blog->update(['meta_tags' => $meta_tags]);
        // } else {
        //     $blog->tags()->sync([]);
        // }
    }



    public function updateBlog(Blog $blog, array $data)
    {
//        dd($data['meta_tags']);

        $blog->update([
            'name' => $data['name'],
            'description' => $data['description'],

            // 'slug' => $this->createUniqueSlug($data['name'], Blog::class, $blog->id),
            // 'meta_description' => $data['meta_description'],
            // 'meta_title' => $data['meta_title'],
            // 'alt_text' => $data['alt_text'],
            // 'category_id'=> $data['category_id']
//            'meta_tags' => $data['meta_tags'],
//            'image' => $image,
//            'meta_image' => $meta_image,
        ]);

        // if (isset($data['meta_tags']) && $data['meta_tags'] != null) {
        //     $tags = $data['meta_tags'];
        //     $new_tags = [];
        //     foreach ($tags as $tag) {
        //         $check = Tag::where('id', $tag)->orWhere('name', $tag)->first();
        //         if ($check) {
        //             $new_tags[] = $check->id;
        //         } else {
        //             $new_tag = Tag::create([
        //                 'name' => $tag,
        //                 'slug' => $this->createUniqueSlug($tag, Tag::class)
        //             ]);
        //             $new_tags[] = $new_tag->id;
        //         }
        //     }
        //     $blog->tags()->sync($new_tags);
        //     $meta_tags = $blog->tags()->pluck('name')->toArray();
        //     $meta_tags = implode(',', $meta_tags);
        //     $blog->update(['meta_tags' => $meta_tags]);
        // } else {
        //     $blog->tags()->sync([]);
        // }

        $this->updateFiles($blog, $data);
    }

    public function deleteBlog(Blog $blog)
    {
        $blog->delete();
    }


    private function storeFiles(Blog $blog, array $data)
    {
        if (isset($data['image'])) {
            $blog->storeFile($data['image'], '_image');
        }

        // if (isset($data['blog_video'])) {
        //     $blog->storeFile($data['blog_video'], 'blog_video');
        // }

        // if (isset($data['meta_image'])) {
        //     $blog->storeFile($data['meta_image'], '_meta_image');
        // }
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


    private function updateFiles(Blog $blog, array $data)
    {
        if (isset($data['image'])) {
            $blog->updateFile($data['image'], '_image');
        }
        // if (isset($data['blog_video'])) {
        //     $blog->storeFile($data['blog_video'], 'blog_video');
        // }


        // if (isset($data['meta_image'])) {
        //     $blog->updateFile($data['meta_image'], '_meta_image');
        // }
    }


    public function reorder($blog, $label, $path, $max_num)
    {
        return ReorderHelper::reorder($blog, $label, $path, $max_num);
    }

    public function saveReorder($all_entries, $blog)
    {
        return ReorderHelper::saveReorder($all_entries, $blog);
    }

}
