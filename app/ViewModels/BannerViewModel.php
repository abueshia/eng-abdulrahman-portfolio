<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use App\Models\Banner;

class BannerViewModel extends ViewModel
{
    public function __construct(public ?Banner $banner = null)
    {
        $this->banner = is_null($banner) ? new Banner(old()) : $banner;
    }

public
function action(): string
{
    return is_null($this->banner->id)
        ? route('admin.banner.store')
        : route('admin.banner.update', ['banner' => $this->banner->id]);
}

public
function method(): string
{
    return is_null($this->banner->id) ? 'POST' : 'PUT';
}
}
