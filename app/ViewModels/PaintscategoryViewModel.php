<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use App\Models\Paintscategory;

class PaintscategoryViewModel extends ViewModel
{
    public function __construct(public ?Paintscategory $paintscategory = null)
    {
        $this->paintscategory = is_null($paintscategory) ? new Paintscategory(old()) : $paintscategory;
    }

    public function action(): string
    {
        return is_null($this->paintscategory->id)
            ? route('admin.paintscategory.store')
            : route('admin.paintscategory.update', ['paintscategory' => $this->paintscategory->id]);
    }

    public function method(): string
    {
        return is_null($this->paintscategory->id) ? 'POST' : 'PUT';
    }
}
