<?php

/**
 * DatabaseSeeder
 *
 * Orchestrates the complete database seeding pipeline for Eng. Abdelrahman Abu Aishah's
 * Portfolio CMS (Admin User, Roles & Permissions, Dynamic Settings, and Portfolio Content).
 */

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            SettingSeeder::class,
            PortfolioSeeder::class,
        ]);
    }
}
