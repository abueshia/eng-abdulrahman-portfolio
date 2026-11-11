<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use App\Models\User;

class ProviderViewModel extends ViewModel
{
    public function __construct(public ?User $provider = null)
    {
        $this->provider = is_null($provider) ? new User(old()) : $provider;
    }

    public function action(): string
    {
        return is_null($this->provider->id)
            ? route('admin.provider.store')
            : route('admin.provider.update', ['provider' => $this->provider->id]);
    }

    public function method(): string
    {
        return is_null($this->provider->id) ? 'POST' : 'PUT';
    }
}
