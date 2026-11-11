<?php

namespace App\Services;

use Spatie\Permission\Models\Role;

class  RoleService
{

    public function createRole($data)
    {
        $role = Role::create([
            'name' => $data['name'],
            'guard_name' => 'admin'
        ]);

        if (array_key_exists('permissions', $data) && $data['permissions'] != '') {
            $role->syncPermissions($data['permissions']);
        }

    }

    public function updateRole($role, $data)
    {
        $role->update([
            'name' => $data['name'],
            'guard_name' => 'admin'
        ]);
        if (array_key_exists('permissions', $data) && $data['permissions'] != '') {
            $role->syncPermissions($data['permissions']);
        }
    }

    public function deleteRole($role)
    {
        $role->delete();
    }


}
