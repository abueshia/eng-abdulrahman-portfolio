<?php

/**
 * SettingSeeder
 *
 * Seeds default bilingual dynamic settings from SettingKeyEnum as the single source of truth
 * across all SettingGroupEnum tabs (General, Hero & CV, About, Contact & Social, SEO,
 * Sections Visibility, and CTA).
 */

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\SettingKeyEnum;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (SettingKeyEnum::cases() as $index => $settingKey) {
            Setting::query()->updateOrCreate(
                ['key' => $settingKey->value],
                [
                    'group' => $settingKey->group(),
                    'option' => $settingKey->value,
                    'value' => $settingKey->default(),
                    'type' => $settingKey->type(),
                    'is_translatable' => $settingKey->isTranslatable(),
                    'sort_order' => $index + 1,
                ]
            );
        }

        Cache::forget('portfolio.settings');
        Cache::forget('settings');
    }
}
