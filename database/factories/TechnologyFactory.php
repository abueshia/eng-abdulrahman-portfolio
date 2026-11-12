<?php

/**
 * TechnologyFactory
 *
 * Generates Technology stack records for automated tests.
 */

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\TechnologyCategoryEnum;
use App\Models\Technology;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Technology>
 */
class TechnologyFactory extends Factory
{
    protected $model = Technology::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $techName = fake()->unique()->domainWord();

        return [
            'name' => [
                'en' => ucfirst($techName),
                'ar' => ucfirst($techName),
            ],
            'slug' => Str::slug($techName).'-'.fake()->unique()->numberBetween(100, 9999),
            'category' => fake()->randomElement(TechnologyCategoryEnum::cases()),
            'icon' => 'fa-solid fa-code',
            'badge_color' => 'primary',
            'proficiency_percent' => fake()->numberBetween(80, 100),
            'years_of_experience' => 4.0,
            'is_featured' => true,
            'is_active' => true,
            'sort_order' => fake()->numberBetween(1, 30),
        ];
    }
}
