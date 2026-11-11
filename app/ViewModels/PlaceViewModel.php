<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use App\Models\Place;

class PlaceViewModel extends ViewModel
{
    public function __construct(public ?Place $place = null)
    {
        $this->place = is_null($place) ? new Place(old()) : $place;
    }

    public function action(): string
    {
        return is_null($this->place->id)
            ? route('admin.place.store')
            : route('admin.place.update', ['place' => $this->place->id]);
    }

    public function method(): string
    {
        return is_null($this->place->id) ? 'POST' : 'PUT';
    }
}
