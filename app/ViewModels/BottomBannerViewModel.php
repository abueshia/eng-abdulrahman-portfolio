<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use App\Models\BottomBanner;

class BottomBannerViewModel extends ViewModel
{
    public function __construct(public ?BottomBanner $bottom_banner = null)
    {
        $this->bottom_banner = is_null($bottom_banner) ? new BottomBanner(old()) : $bottom_banner;
    }

public
function action(): string
{
    return is_null($this->bottom_banner->id)
        ? route('admin.bottom_banner.store')
        : route('admin.bottom_banner.update', ['bottom_banner' => $this->bottom_banner->id]);
}

public
function method(): string
{
    return is_null($this->bottom_banner->id) ? 'POST' : 'PUT';
}
}
