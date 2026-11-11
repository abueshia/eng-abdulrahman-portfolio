<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use App\Models\ServiceSubCategory;

class ServiceSubCategoryViewModel extends ViewModel
{
    public function __construct(public ?ServiceSubCategory $service_sub_category = null)
    {
        $this->service_sub_category = is_null($service_sub_category) ? new ServiceSubCategory(old()) : $service_sub_category;
    }

    public function action(): string
    {
        return is_null($this->service_sub_category->id)
            ? route('admin.service_sub_category.store')
            : route('admin.service_sub_category.update', ['service_sub_category' => $this->service_sub_category->id]);
    }

    public function method(): string
    {
        return is_null($this->service_sub_category->id) ? 'POST' : 'PUT';
    }
}
