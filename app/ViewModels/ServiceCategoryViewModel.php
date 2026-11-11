<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use App\Models\ServiceCategory;

class ServiceCategoryViewModel extends ViewModel
{
    public function __construct(public ?ServiceCategory $service_category = null)
    {
        $this->service_category = is_null($service_category) ? new ServiceCategory(old()) : $service_category;
    }

    public function action(): string
    {
        return is_null($this->service_category->id)
            ? route('admin.service_category.store')
            : route('admin.service_category.update', ['service_category' => $this->service_category->id]);
    }

    public function method(): string
    {
        return is_null($this->service_category->id) ? 'POST' : 'PUT';
    }
}
