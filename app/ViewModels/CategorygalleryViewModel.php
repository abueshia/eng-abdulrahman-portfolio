<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use App\Models\Categorygallery;

class CategorygalleryViewModel extends ViewModel
{
    public function __construct(public ?Categorygallery $categorygallery = null)
    {
        $this->categorygallery = is_null($categorygallery) ? new Categorygallery(old()) : $categorygallery;
    }

    public function action(): string
    {
        return is_null($this->categorygallery->id)
            ? route('admin.categorygallery.store')
            : route('admin.categorygallery.update', ['categorygallery' => $this->categorygallery->id]);
    }

    public function method(): string
    {
        return is_null($this->categorygallery->id) ? 'POST' : 'PUT';
    }
}
