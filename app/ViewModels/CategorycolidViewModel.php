<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use App\Models\Categorycolid;

class CategorycolidViewModel extends ViewModel
{
    public function __construct(public ?Categorycolid $categorycolid = null)
    {
        $this->categorycolid = is_null($categorycolid) ? new Categorycolid(old()) : $categorycolid;
    }

    public function action(): string
    {
        return is_null($this->categorycolid->id)
            ? route('admin.categorycolid.store')
            : route('admin.categorycolid.update', ['categorycolid' => $this->categorycolid->id]);
    }

    public function method(): string
    {
        return is_null($this->categorycolid->id) ? 'POST' : 'PUT';
    }
}
