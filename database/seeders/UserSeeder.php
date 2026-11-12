<?php

/**
 * UserSeeder
 *
 * Seeds the default administrator account for Eng. Abdelrahman Abu Aishah's Portfolio CMS.
 * Credentials are read from environment variables with safe development fallbacks.
 */

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email = (string) env('PORTFOLIO_ADMIN_EMAIL', 'admin@example.com');
        $password = (string) env('PORTFOLIO_ADMIN_PASSWORD', 'password');

        User::query()->updateOrCreate(
            ['email' => $email],
            [
                'name' => (string) env('PORTFOLIO_ADMIN_FIRST_NAME', 'Abdelrahman'),
                'l_name' => (string) env('PORTFOLIO_ADMIN_LAST_NAME', 'Abu Aishah'),
                'username' => (string) env('PORTFOLIO_ADMIN_USERNAME', 'abdelrahman'),
                'phone' => (string) env('PORTFOLIO_ADMIN_PHONE', '+201000000000'),
                'type' => 'admin',
                'is_admin' => true,
                'email_verified_at' => now(),
                'password' => Hash::make($password),
            ]
        );
    }
}
