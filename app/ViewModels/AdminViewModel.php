<?php

declare(strict_types=1);

namespace App\ViewModels;

use App\Models\User;
use Spatie\ViewModels\ViewModel;

class AdminViewModel extends ViewModel
{
    public function __construct(public ?User $admin = null)
    {
        $this->admin = is_null($admin) ? new User(old()) : $admin;
    }

    public function action(): string
    {
        return is_null($this->admin->id)
            ? route('admin.admin.store')
            : route('admin.admin.update', ['admin' => $this->admin->id]);
    }

    public function method(): string
    {
        return is_null($this->admin->id) ? 'POST' : 'PUT';
    }
}
