<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use App\Models\Gallery;
use App\Models\Category;
use App\Models\Categorygallery;

class GalleryViewModel extends ViewModel
{
    public function __construct(public ?Gallery $gallery = null)
    {
        $this->gallery = is_null($gallery) ? new Gallery(old()) : $gallery;
    }

    public function action(): string
    {
        return is_null($this->gallery->id)
            ? route('admin.gallery.store')
            : route('admin.gallery.update', ['gallery' => $this->gallery->id]);
    }

    public function method(): string
    {
        return is_null($this->gallery->id) ? 'POST' : 'PUT';
    }



    public function categories()
    {
        return Categorygallery::all();
    }
}
