<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use App\Models\Service;

class ServiceViewModel extends ViewModel
{
    public function __construct(public ?Service $service = null)
    {
        $this->service = is_null($service) ? new Service(old()) : $service;
    }

    public function action(): string
    {
        return is_null($this->service->id)
            ? route('admin.service.store')
            : route('admin.service.update', ['service' => $this->service->id]);
    }

    public function method(): string
    {
        return is_null($this->service->id) ? 'POST' : 'PUT';
    }
}
