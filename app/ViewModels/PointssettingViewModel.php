<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use App\Models\Pointssetting;

class PointssettingViewModel extends ViewModel
{
    public function __construct(public ?Pointssetting $pointssetting = null)
    {
        $this->pointssetting = is_null($pointssetting) ? new Pointssetting(old()) : $pointssetting;
    }

    public function action(): string
    {
        return is_null($this->pointssetting->id)
            ? route('admin.pointssetting.store')
            : route('admin.pointssetting.update', ['pointssetting' => $this->pointssetting->id]);
    }

    public function method(): string
    {
        return is_null($this->pointssetting->id) ? 'POST' : 'PUT';
    }
}
