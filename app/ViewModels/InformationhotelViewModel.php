<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use App\Models\Informationhotel;

class InformationhotelViewModel extends ViewModel
{
    public function __construct(public ?Informationhotel $informationhotel = null)
    {
        $this->informationhotel = is_null($informationhotel) ? new Informationhotel(old()) : $informationhotel;
    }

    public function action(): string
    {
        return is_null($this->informationhotel->id)
            ? route('admin.informationhotel.store')
            : route('admin.informationhotel.update', ['informationhotel' => $this->informationhotel->id]);
    }

    public function method(): string
    {
        return is_null($this->informationhotel->id) ? 'POST' : 'PUT';
    }
}
