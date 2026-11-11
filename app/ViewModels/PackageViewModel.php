<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use App\Models\Package;

class PackageViewModel extends ViewModel
{
    public function __construct(public ?Package $package = null)
    {
        $this->package = is_null($package) ? new Package(old()) : $package;
    }

    public function action(): string
    {
        return is_null($this->package->id)
            ? route('admin.package.store')
            : route('admin.package.update', ['package' => $this->package->id]);
    }

    public function method(): string
    {
        return is_null($this->package->id) ? 'POST' : 'PUT';
    }
}
