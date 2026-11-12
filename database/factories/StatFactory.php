<?php

/**
 * StatFactory
 *
 * Generates quantitative career Stat records for automated tests.
 */

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Stat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Stat>
 */
class StatFactory extends Factory
{
    protected $model = Stat::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'label' => [
                'en' => 'Years of Software Engineering Experience',
                'ar' => 'سنوات الخبرة البرمجية',
            ],
            'value' => '4',
            'prefix' => '+',
            'suffix' => null,
            'icon' => 'fa-solid fa-code',
            'is_active' => true,
            'sort_order' => fake()->numberBetween(1, 10),
        ];
    }
}
