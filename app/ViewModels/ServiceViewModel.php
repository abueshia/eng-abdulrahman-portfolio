<?php

/**
 * ServiceViewModel
 *
 * Supplies form state and route action/method to the Admin Service create/edit form view.
 */

declare(strict_types=1);

namespace App\ViewModels;

use App\Models\Service;
use Spatie\ViewModels\ViewModel;

class ServiceViewModel extends ViewModel
{
    public Service $service;

    public function __construct(?Service $service = null)
    {
        $this->service = $service ?? new Service([
            'is_active' => true,
            'is_featured' => false,
        ]);
    }

    public function action(): string
    {
        return $this->service->exists
            ? route('admin.service.update', ['service' => $this->service->id])
            : route('admin.service.store');
    }

    public function method(): string
    {
        return $this->service->exists ? 'PUT' : 'POST';
    }
}
