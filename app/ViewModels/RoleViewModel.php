<?php

declare(strict_types=1);

namespace App\ViewModels;

use Spatie\Permission\Models\Role;
use Spatie\ViewModels\ViewModel;

class RoleViewModel extends ViewModel
{
    public function __construct(public ?Role $role = null)
    {
        $this->role = is_null($role) ? new Role(old()) : $role;
    }

    public function action(): string
    {
        return is_null($this->role->id)
            ? route('admin.role.store')
            : route('admin.role.update', ['role' => $this->role->id]);
    }

    public function method(): string
    {
        return is_null($this->role->id) ? 'POST' : 'PUT';
    }
}
