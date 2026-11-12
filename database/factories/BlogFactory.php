<?php

/**
 * BlogFactory
 *
 * Generates bilingual technical article (Blog) records for automated tests.
 */

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\BlogStatusEnum;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Blog>
 */
class BlogFactory extends Factory
{
    protected $model = Blog::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $enTitle = fake()->unique()->sentence(5);

        return [
            'category_id' => Category::factory(),
            'name' => [
                'en' => $enTitle,
                'ar' => 'مقال تقني: '.fake()->words(3, true),
            ],
            'slug' => Str::slug($enTitle).'-'.fake()->unique()->numberBetween(100, 9999),
            'short_description' => [
                'en' => fake()->sentence(),
                'ar' => 'ملخص المقال التقني حول هندسة البرمجيات وتطوير الأنظمة.',
            ],
            'description' => [
                'en' => fake()->paragraphs(3, true),
                'ar' => 'شرح تفصيلي لأفضل الممارسات المعمارية في PHP 8.3 و Laravel و React.js.',
            ],
            'reading_time_minutes' => 6,
            'views_count' => fake()->numberBetween(10, 500),
            'status' => BlogStatusEnum::Published,
            'is_featured' => true,
            'is_active' => true,
            'published_at' => now()->subDays(5),
            'sort_order' => fake()->numberBetween(1, 20),
        ];
    }
}
