<?php

/**
 * RoleSeeder
 *
 * Seeds the Super Admin role and module permissions on the 'admin' guard.
 */

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $superAdmin = Role::query()->firstOrCreate([
            'name' => 'Super admin',
            'guard_name' => 'admin',
        ]);

        $modules = [
            'roles' => ['view_all', 'create', 'edit', 'delete'],
            'admins' => ['view_all', 'view_details', 'create', 'edit', 'delete'],
            'projects' => ['view_all', 'view_details', 'create', 'edit', 'delete', 'sort'],
            'technologies' => ['view_all', 'view_details', 'create', 'edit', 'delete', 'sort'],
            'experiences' => ['view_all', 'view_details', 'create', 'edit', 'delete', 'sort'],
            'credentials' => ['view_all', 'view_details', 'create', 'edit', 'delete', 'sort'],
            'services' => ['view_all', 'view_details', 'create', 'edit', 'delete', 'sort'],
            'testimonial' => ['view_all', 'view_details', 'create', 'edit', 'delete', 'sort'],
            'categories' => ['view_all', 'view_details', 'create', 'edit', 'delete', 'sort'],
            'blogs' => ['view_all', 'view_details', 'create', 'edit', 'delete', 'sort'],
            'messages' => ['view_all', 'view_details', 'edit', 'delete'],
            'faqs' => ['view_all', 'view_details', 'create', 'edit', 'delete', 'sort'],
            'stats' => ['view_all', 'view_details', 'create', 'edit', 'delete', 'sort'],
            'all_settings' => ['view_all'],
            'mainSetting' => ['view_details', 'edit'],
        ];

        $permissionInstances = [];

        foreach ($modules as $module => $actions) {
            foreach ($actions as $action) {
                $permissionInstances[] = Permission::query()->firstOrCreate([
                    'name' => "{$module}.{$action}",
                    'guard_name' => 'admin',
                ]);
            }
        }

        $superAdmin->syncPermissions($permissionInstances);

        $admin = User::query()->where('is_admin', true)->first();
        if ($admin !== null) {
            $admin->assignRole($superAdmin);
        }
    }
}
