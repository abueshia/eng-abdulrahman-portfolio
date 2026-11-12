<?php

declare(strict_types=1);

namespace App\ViewModels;

use App\Models\Blog;
use App\Models\Category;
use Spatie\ViewModels\ViewModel;

class BlogViewModel extends ViewModel
{
    public function __construct(public ?Blog $blog = null)
    {
        $this->blog = is_null($blog) ? new Blog(old()) : $blog;
    }

    public function action(): string
    {
        return is_null($this->blog->id)
            ? route('admin.blog.store')
            : route('admin.blog.update', ['blog' => $this->blog->id]);
    }

    public function method(): string
    {
        return is_null($this->blog->id) ? 'POST' : 'PUT';
    }

    public function categories()
    {
        return Category::all();
    }
}
