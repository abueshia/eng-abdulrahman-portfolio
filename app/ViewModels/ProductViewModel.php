<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use App\Models\Product;

class ProductViewModel extends ViewModel
{
    public function __construct(public ?Product $product = null)
    {
        $this->product = is_null($product) ? new Product(old()) : $product;
    }

    public function action(): string
    {
        return is_null($this->product->id)
            ? route('admin.product.store')
            : route('admin.product.update', ['product' => $this->product->id]);
    }

    public function method(): string
    {
        return is_null($this->product->id) ? 'POST' : 'PUT';
    }
}
