<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $admin =  User::where('is_admin', 1)->first();

        Permission::query()->delete();

        //=============================Super-admin===============================================
        $superAdmin = Role::firstOrCreate([
            'name'          => 'Super admin',
        ]);
        //        dd($admin);

        $admin->assignRole($superAdmin);

        $permissions = [
            ['name' => 'roles.view_all'],
            ['name' => 'roles.create'],
            ['name' => 'roles.edit'],
            ['name' => 'roles.delete'],


            ['name' => 'admins.view_all'],
            ['name' => 'admins.view_details'],
            ['name' => 'admins.create'],
            ['name' => 'admins.edit'],
            ['name' => 'admins.delete'],



            ['name' => 'product.view_all'],
            ['name' => 'product.view_details'],
            ['name' => 'product.create'],
            ['name' => 'product.edit'],
            ['name' => 'product.delete'],
            // ['name' => 'product.sort'],

            ['name' => 'productcategory.view_all'],
            ['name' => 'productcategory.view_details'],
            ['name' => 'productcategory.create'],
            ['name' => 'productcategory.edit'],
            ['name' => 'productcategory.delete'],



            // banner 
            ['name' => 'banner.view_all'],
            ['name' => 'banner.view_details'],
            ['name' => 'banner.create'],
            ['name' => 'banner.edit'],
            ['name' => 'banner.delete'],
            ['name' => 'banner.sort'],

            // about_us
            ['name' => 'about_us.view_all'],
            ['name' => 'about_us.view_details'],
            ['name' => 'about_us.create'],
            ['name' => 'about_us.edit'],
            ['name' => 'about_us.delete'],


            //contact
            ['name' => 'contact.view_all'],
            ['name' => 'contact.view_details'],
            ['name' => 'contact.create'],
            ['name' => 'contact.edit'],
            ['name' => 'contact.delete'],


            // testimonial
            ['name' => 'testimonial.view_all'],
            ['name' => 'testimonial.view_details'],
            ['name' => 'testimonial.create'],
            ['name' => 'testimonial.edit'],
            ['name' => 'testimonial.delete'],
            ['name' => 'testimonial.sort'],


            // all_settings
            ['name' => 'all_settings.view_all'],

            ['name' => 'mainSetting.view_details'],
            ['name' => 'mainSetting.edit'],


            ['name' => 'home_couronne_setting.view_details'],
            ['name' => 'home_couronne_setting.edit'],

        ];

        foreach ($permissions as $permission) {
            $name = isset($permission['name']) ? $permission['name'] : null;
            $createdPermission = Permission::firstOrCreate([
                'name'          => $name,
                'guard_name' => 'admin'
            ]);
            $superAdmin->givePermissionTo($createdPermission);
        }
    }
}
