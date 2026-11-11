<?php

namespace Database\Seeders;

use Faker\Guesser\Name;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Super',
            'l_name' => 'Admin',
            'email' => 'admin@admin.com',
            'phone' => '123456789',
            'username' => 'admin_username',
            'password' => Hash::make('123456789'),
            'email_verified_at'=>now(),
            'is_admin'=>1
        ]);
    }
}
