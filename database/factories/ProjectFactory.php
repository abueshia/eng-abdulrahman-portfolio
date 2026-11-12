<?php

/**
 * ProjectFactory
 *
 * Generates bilingual software engineering Project case study records for automated tests.
 */

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\ProjectStatusEnum;
use App\Enums\ProjectTypeEnum;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $enTitle = fake()->unique()->sentence(3);

        return [
            'category_id' => Category::factory(),
            'title' => [
                'en' => $enTitle,
                'ar' => 'مشروع '.fake()->words(2, true),
            ],
            'slug' => Str::slug($enTitle).'-'.fake()->unique()->numberBetween(100, 9999),
            'subtitle' => [
                'en' => 'Enterprise Laravel & React Architecture',
                'ar' => 'معمارية متكاملة باستخدام Laravel و React',
            ],
            'short_description' => [
                'en' => fake()->paragraph(),
                'ar' => 'وصف مختصر للمشروع البرمجي والمعمارية المستخدمة.',
            ],
            'description' => [
                'en' => fake()->paragraphs(2, true),
                'ar' => 'تفاصيل شاملة عن بناء النظام ولوحة التحكم والـ REST API.',
            ],
            'challenge' => [
                'en' => 'High concurrency and legacy database bottlenecks.',
                'ar' => 'معالجة الضغط العالي وتحسين أداء الاستعلامات المعقدة.',
            ],
            'solution' => [
                'en' => 'Implemented Repository Pattern, Redis caching, and modular Services.',
                'ar' => 'تطبيق نمط المستودعات والخدمات مع التخزين المؤقت عبر Redis.',
            ],
            'results' => [
                'en' => 'Reduced API response time by 65% and achieved 99.9% uptime.',
                'ar' => 'تقليص زمن استجابة الـ API بنسبة 65% واستقرار النظام بنسبة 99.9%.',
            ],
            'client_name' => [
                'en' => fake()->company(),
                'ar' => 'شركة تقنية',
            ],
            'role_title' => [
                'en' => 'Lead Full-Stack Software Engineer',
                'ar' => 'مهندس برمجيات متكامل (Full-Stack)',
            ],
            'project_type' => ProjectTypeEnum::FullStack,
            'status' => ProjectStatusEnum::Published,
            'live_url' => 'https://example.com',
            'repo_url' => 'https://github.com/abdelrahman/project',
            'completed_at' => now()->subMonths(2)->toDateString(),
            'duration' => [
                'en' => '3 Months',
                'ar' => '3 أشهر',
            ],
            'metrics' => [
                ['label_en' => 'Response Time', 'label_ar' => 'سرعة الاستجابة', 'value' => '< 85ms'],
            ],
            'is_featured' => true,
            'is_active' => true,
            'sort_order' => fake()->numberBetween(1, 20),
        ];
    }
}
