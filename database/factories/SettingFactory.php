<?php

/**
 * SettingFactory
 *
 * Generates dynamic Setting records for automated tests.
 */

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\SettingGroupEnum;
use App\Enums\SettingTypeEnum;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Setting>
 */
class SettingFactory extends Factory
{
    protected $model = Setting::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $key = 'setting_'.fake()->unique()->lexify('??????');

        return [
            'group' => SettingGroupEnum::General,
            'key' => $key,
            'option' => $key,
            'value' => [
                'en' => 'English Setting Value',
                'ar' => 'قيمة الإعداد بالعربية',
            ],
            'type' => SettingTypeEnum::Text,
            'is_translatable' => true,
            'sort_order' => 1,
        ];
    }
}
