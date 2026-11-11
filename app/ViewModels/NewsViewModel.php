<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use App\Models\News;

class NewsViewModel extends ViewModel
{
    public function __construct(public ?News $news = null)
    {
        $this->news = is_null($news) ? new News(old()) : $news;
    }

public function action(): string
{
    return is_null($this->news->id)
        ? route('admin.news.store')
        : route('admin.news.update', ['news' => $this->news->id]);
}

public
function method(): string
{
    return is_null($this->news->id) ? 'POST' : 'PUT';
}
}
