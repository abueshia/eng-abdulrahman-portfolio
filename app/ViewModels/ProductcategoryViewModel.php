<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use App\Models\Productcategory;

class ProductcategoryViewModel extends ViewModel
{
    public function __construct(public ?Productcategory $productcategory = null)
    {
        $this->productcategory = is_null($productcategory) ? new Productcategory(old()) : $productcategory;
    }

    public function action(): string
    {
        return is_null($this->productcategory->id)
            ? route('admin.productcategory.store')
            : route('admin.productcategory.update', ['productcategory' => $this->productcategory->id]);
    }

    public function method(): string
    {
        return is_null($this->productcategory->id) ? 'POST' : 'PUT';
    }
}
