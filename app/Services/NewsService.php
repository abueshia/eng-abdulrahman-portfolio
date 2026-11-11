<?php
namespace App\Services;

use App\Helpers\ReorderHelper;
use App\Models\News;

class  NewsService{


    public function createNews($data)
    {
        // dd($data);
        $news = News::create($data);

        if (isset($data['image'])) {
            $news->storeFile($data['image']);
        }

        if (isset($data['news_video'])) {
            $news->storeFile($data['news_video'], 'news_video');
        }
    }




    public function updateNews($news , $data){
        // dd($data);
        if(isset($data['image'])){
            $news->updateFile($data['image']);
        }

        if (isset($data['news_video'])) {
            $news->storeFile($data['news_video'], 'news_video');
        }
        $news->update($data);
    }



    public function deleteNews($news){
        $news->delete();
    }


   

    public function reorder($news, $label , $path, $max_num)
    {
        return ReorderHelper::reorder($news, $label , $path, $max_num);
    }

    public function saveReorder ($all_entries, $news)
    {
        return ReorderHelper::saveReorder($all_entries, $news);
    }



}
