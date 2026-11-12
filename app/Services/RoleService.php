<?php

declare(strict_types=1);

namespace App\Services;

use Spatie\Permission\Models\Role;

class RoleService
{
    public function createRole($data): void
    {
        $role = Role::create([
            'name' => $data['name'],
            'guard_name' => 'admin',
        ]);

        if (array_key_exists('permissions', $data) && $data['permissions'] != '') {
            $role->syncPermissions($data['permissions']);
        }

    }

    public function updateRole($role, $data): void
    {
        $role->update([
            'name' => $data['name'],
            'guard_name' => 'admin',
        ]);
        if (array_key_exists('permissions', $data) && $data['permissions'] != '') {
            $role->syncPermissions($data['permissions']);
        }
    }

    public function deleteRole($role): void
    {
        $role->delete();
    }
}
