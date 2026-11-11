<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use App\Models\Region;

class RegionViewModel extends ViewModel
{
    public function __construct(public ?Region $region = null)
    {
        $this->region = is_null($region) ? new Region(old()) : $region;
    }

    public function action(): string
    {
        return is_null($this->region->id)
            ? route('admin.region.store')
            : route('admin.region.update', ['region' => $this->region->id]);
    }

    public function method(): string
    {
        return is_null($this->region->id) ? 'POST' : 'PUT';
    }
}
