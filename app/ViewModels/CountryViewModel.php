<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use App\Models\Country;

class CountryViewModel extends ViewModel
{
    public function __construct(public ?Country $country = null)
    {
        $this->country = is_null($country) ? new Country(old()) : $country;
    }

    public function action(): string
    {
        return is_null($this->country->id)
            ? route('admin.country.store')
            : route('admin.country.update', ['country' => $this->country->id]);
    }

    public function method(): string
    {
        return is_null($this->country->id) ? 'POST' : 'PUT';
    }
}
