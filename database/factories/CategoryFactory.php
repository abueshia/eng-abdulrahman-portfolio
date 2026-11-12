<?php

/**
 * CategoryFactory
 *
 * Generates bilingual Category records for automated tests.
 */

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $enName = fake()->unique()->words(2, true);

        return [
            'name' => [
                'en' => ucwords($enName),
                'ar' => 'تصنيف '.fake()->word(),
            ],
            'slug' => Str::slug($enName).'-'.fake()->unique()->numberBetween(100, 9999),
            'description' => [
                'en' => fake()->sentence(),
                'ar' => 'وصف التصنيف البرمجي.',
            ],
            'is_active' => true,
            'sort_order' => fake()->numberBetween(1, 50),
        ];
    }
}
