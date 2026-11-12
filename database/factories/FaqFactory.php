<?php

/**
 * FaqFactory
 *
 * Generates bilingual FAQ records for automated tests.
 */

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Faq;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Faq>
 */
class FaqFactory extends Factory
{
    protected $model = Faq::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question' => [
                'en' => fake()->sentence().'?',
                'ar' => 'ما هي منهجية العمل في بناء الأنظمة البرمجية؟',
            ],
            'answer' => [
                'en' => fake()->paragraph(),
                'ar' => 'نعتمد على Clean Architecture ومبادئ SOLID مع اختبارات آلية شاملة.',
            ],
            'category' => 'architecture',
            'is_active' => true,
            'sort_order' => fake()->numberBetween(1, 15),
        ];
    }
}
