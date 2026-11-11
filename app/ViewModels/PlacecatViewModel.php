<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use App\Models\Placecat;

class PlacecatViewModel extends ViewModel
{
    public function __construct(public ?Placecat $placecat = null)
    {
        $this->placecat = is_null($placecat) ? new Placecat(old()) : $placecat;
    }

    public function action(): string
    {
        return is_null($this->placecat->id)
            ? route('admin.placecat.store')
            : route('admin.placecat.update', ['placecat' => $this->placecat->id]);
    }

    public function method(): string
    {
        return is_null($this->placecat->id) ? 'POST' : 'PUT';
    }
}
