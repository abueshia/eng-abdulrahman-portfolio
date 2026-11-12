<?php

/**
 * ServiceFactory
 *
 * Generates software engineering Service records for automated tests.
 */

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Service>
 */
class ServiceFactory extends Factory
{
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $enTitle = fake()->unique()->words(3, true);

        return [
            'title' => [
                'en' => ucwords($enTitle),
                'ar' => 'خدمة تطوير البرمجيات المتكاملة',
            ],
            'slug' => Str::slug($enTitle).'-'.fake()->unique()->numberBetween(100, 9999),
            'subtitle' => [
                'en' => 'High-Performance Backend & Modern UI',
                'ar' => 'أداء فائق ومعمارية نظيفة',
            ],
            'short_description' => [
                'en' => fake()->sentence(),
                'ar' => 'بناء أنظمة ويب متكاملة وآمنة باستخدام PHP Laravel و React.js.',
            ],
            'description' => [
                'en' => fake()->paragraph(),
                'ar' => 'تفاصيل الخدمة البرمجية ومعايير الجودة والأمان المتبعة.',
            ],
            'features' => [
                'en' => 'Clean Architecture, SOLID Principles, Automated Testing',
                'ar' => 'معمارية نظيفة، مبادئ SOLID، اختبارات آلية شاملة',
            ],
            'icon' => 'fa-solid fa-layer-group',
            'is_featured' => true,
            'is_active' => true,
            'sort_order' => fake()->numberBetween(1, 10),
        ];
    }
}
