<?php

/**
 * TestimonialFactory
 *
 * Generates client Testimonial records for automated tests.
 */

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Testimonial>
 */
class TestimonialFactory extends Factory
{
    protected $model = Testimonial::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project_id' => null,
            'name' => [
                'en' => fake()->name(),
                'ar' => 'م. أحمد محمود',
            ],
            'name_job' => [
                'en' => 'CTO & Co-Founder',
                'ar' => 'المدير التقني (CTO)',
            ],
            'company_name' => [
                'en' => fake()->company(),
                'ar' => 'شركة حلول رقمية',
            ],
            'description' => [
                'en' => 'Eng. Abdelrahman delivered an exceptional Laravel & React platform ahead of schedule.',
                'ar' => 'قدم المهندس عبدالرحمن أبو عيشة نظاماً برمجياً متكاملاً بأعلى معايير النظافة والأداء.',
            ],
            'rating' => 5,
            'is_featured' => true,
            'is_active' => true,
            'sort_order' => fake()->numberBetween(1, 10),
        ];
    }
}
