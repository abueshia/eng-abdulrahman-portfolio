<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use App\Models\Affgallery;
// use App\Models\Category;

class AffgalleryViewModel extends ViewModel
{
    public function __construct(public ?Affgallery $affgallery = null)
    {
        $this->affgallery = is_null($affgallery) ? new Affgallery(old()) : $affgallery;
    }

    public function affgallery(): Affgallery
    {
        return $this->affgallery;
    }

    public function action(): string
    {
        return is_null($this->affgallery->id)
            ? route('admin.aff_gallery.store', ['gallery_id' => $this->gallery_id ?? request()->gallery_id])

            : route('admin.aff_gallery.update', ['gallery_id' => $this->gallery_id ?? request()->gallery_id, 'affgallery' => $this->affgallery->id]);
    }

    public function method(): string
    {
        return is_null($this->affgallery->id) ? 'POST' : 'PUT';
    }



    // public function categories()
    // {
    //     return Category::all();
    // }
}
