<?php

/**
 * ExperienceFactory
 *
 * Generates professional work Experience timeline records for automated tests.
 */

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\EmploymentTypeEnum;
use App\Models\Experience;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Experience>
 */
class ExperienceFactory extends Factory
{
    protected $model = Experience::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_name' => [
                'en' => fake()->company(),
                'ar' => 'شركة برمجيات متقدمة',
            ],
            'role_title' => [
                'en' => 'Senior Full-Stack Engineer (PHP Laravel & React.js)',
                'ar' => 'مهندس برمجيات متكامل (PHP Laravel & React.js)',
            ],
            'employment_type' => EmploymentTypeEnum::FullTime,
            'location' => [
                'en' => 'Cairo, Egypt (Hybrid)',
                'ar' => 'القاهرة، مصر',
            ],
            'company_url' => 'https://example.com',
            'start_date' => now()->subYears(2)->toDateString(),
            'end_date' => null,
            'is_current' => true,
            'summary' => [
                'en' => 'Architected scalable backend APIs and interactive React dashboards.',
                'ar' => 'تصميم وتطوير أنظمة باك إند قابلة للتوسع ولوحات تحكم تفاعلية.',
            ],
            'achievements' => [
                'en' => 'Delivered 10+ enterprise modules following SOLID principles.',
                'ar' => 'تسليم أكثر من 10 أنظمة برمجية متكاملة وفق مبادئ SOLID.',
            ],
            'is_active' => true,
            'sort_order' => 1,
        ];
    }
}
