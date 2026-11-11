<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use App\Models\Branche;

class BrancheViewModel extends ViewModel
{
    public function __construct(public ?Branche $branche = null)
    {
        $this->branche = is_null($branche) ? new Branche(old()) : $branche;
    }

    public function action(): string
    {
        return is_null($this->branche->id)
            ? route('admin.branche.store')
            : route('admin.branche.update', ['branche' => $this->branche->id]);
    }

    public function method(): string
    {
        return is_null($this->branche->id) ? 'POST' : 'PUT';
    }
}
