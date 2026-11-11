<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use App\Models\Informationflight;

class InformationflightViewModel extends ViewModel
{
    public function __construct(public ?Informationflight $informationflight = null)
    {
        $this->informationflight = is_null($informationflight) ? new Informationflight(old()) : $informationflight;
    }

    public function action(): string
    {
        return is_null($this->informationflight->id)
            ? route('admin.informationflight.store')
            : route('admin.informationflight.update', ['informationflight' => $this->informationflight->id]);
    }

    public function method(): string
    {
        return is_null($this->informationflight->id) ? 'POST' : 'PUT';
    }
}
