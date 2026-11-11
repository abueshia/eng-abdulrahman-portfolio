<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $models = getSeparatedModels()['full_crud']; // Add your models here

        $actions = ['view_all', 'view_details', 'create', 'update', 'delete'];

        foreach ($models as $model) {
            foreach ($actions as $action) {
                $permissionName = "{$action} {$model}";

                if (!Permission::where('name', $permissionName)->exists()) {
                    Permission::create(['name' => $permissionName]);
                }
            }
        }

        $models = getSeparatedModels()['some_crud']; // Add your models here


        $actions = ['view_all', 'view_details', 'update'];

        foreach ($models as $model) {
            foreach ($actions as $action) {
                $permissionName = "{$action} {$model}";

                if (!Permission::where('name', $permissionName)->exists()) {
                    Permission::create(['name' => $permissionName]);
                }
            }
        }
    }
}
