<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use App\Models\Informationtour;

class InformationtourViewModel extends ViewModel
{
    public function __construct(public ?Informationtour $informationtour = null)
    {
        $this->informationtour = is_null($informationtour) ? new Informationtour(old()) : $informationtour;
    }

    public function action(): string
    {
        return is_null($this->informationtour->id)
            ? route('admin.informationtour.store')
            : route('admin.informationtour.update', ['informationtour' => $this->informationtour->id]);
    }

    public function method(): string
    {
        return is_null($this->informationtour->id) ? 'POST' : 'PUT';
    }
}
