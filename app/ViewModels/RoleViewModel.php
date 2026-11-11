<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use Spatie\Permission\Models\Role;

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
