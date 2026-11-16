<?php

/**
 * AdminDashboardTest
 *
 * Feature tests for Phase 5C: DashboardController, DashboardStatisticsService,
 * permission-aware sidebar navigation, unread messages badge, and RTL/LTR layout switching.
 */

declare(strict_types=1);

namespace Tests\Feature\Admin;

use App\Enums\BlogStatusEnum;
use App\Enums\ContactMessageStatusEnum;
use App\Enums\ContactMessageTypeEnum;
use App\Enums\EmploymentTypeEnum;
use App\Enums\ProjectStatusEnum;
use App\Enums\ProjectTypeEnum;
use App\Enums\TechnologyCategoryEnum;
use App\Models\Blog;
use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Technology;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    private User $superAdmin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->refreshApplicationWithLocale('en');
        $this->seed(RoleSeeder::class);

        $this->superAdmin = User::factory()->create([
            'name' => 'Eng. Abdelrahman Abu Aishah',
            'email' => 'admin@abdelrahman.dev',
            'is_admin' => true,
        ]);

        $this->superAdmin->assignRole('Super admin');
    }

    /**
     * Ensure the dashboard renders KPI statistics, latest projects, latest messages,
     * and the 6-month contact messages chart for a Super Admin in English (LTR).
     */
    public function test_dashboard_renders_statistics_latest_records_and_monthly_chart_for_super_admin(): void
    {
        $category = Category::query()->create([
            'name' => ['ar' => 'تطبيقات الويب', 'en' => 'Web Applications'],
            'slug' => 'web-applications',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        Project::query()->create([
            'category_id' => $category->id,
            'title' => ['ar' => 'منصة إدارة المشاريع', 'en' => 'Enterprise Project Suite'],
            'slug' => 'enterprise-project-suite',
            'short_description' => ['ar' => 'وصف مختصر', 'en' => 'Short summary'],
            'description' => ['ar' => 'تفاصيل المشروع', 'en' => 'Full project description'],
            'project_type' => ProjectTypeEnum::Saas,
            'status' => ProjectStatusEnum::Published,
            'is_featured' => true,
            'is_active' => true,
            'sort_order' => 1,
        ]);

        Technology::query()->create([
            'name' => ['ar' => 'Laravel 10', 'en' => 'Laravel 10'],
            'slug' => 'laravel-10',
            'category' => TechnologyCategoryEnum::Backend,
            'proficiency_percent' => 95,
            'is_featured' => true,
            'is_active' => true,
            'sort_order' => 1,
        ]);

        Experience::query()->create([
            'company_name' => ['ar' => 'شركة تقنية', 'en' => 'Tech Solutions Inc.'],
            'role_title' => ['ar' => 'مهندس برمجيات أول', 'en' => 'Senior Software Engineer'],
            'summary' => ['ar' => 'قيادة فريق التطوير', 'en' => 'Leading the backend engineering team'],
            'employment_type' => EmploymentTypeEnum::FullTime,
            'start_date' => '2022-01-01',
            'is_current' => true,
            'is_active' => true,
            'sort_order' => 1,
        ]);

        Blog::query()->create([
            'category_id' => $category->id,
            'name' => ['ar' => 'معمارية لارافيل النظيفة', 'en' => 'Clean Laravel Architecture'],
            'slug' => 'clean-laravel-architecture',
            'short_description' => ['ar' => 'ملخص المقال', 'en' => 'Article summary'],
            'description' => ['ar' => 'محتوى المقال', 'en' => 'Article body'],
            'status' => BlogStatusEnum::Published,
            'published_at' => now(),
            'sort_order' => 1,
        ]);

        ContactMessage::query()->create([
            'name' => 'Ahmed Client',
            'email' => 'ahmed@example.com',
            'phone' => '+201000000001',
            'subject' => 'SaaS Platform Inquiry',
            'message' => 'We need a senior Laravel & React engineer.',
            'type' => ContactMessageTypeEnum::ProjectInquiry,
            'status' => ContactMessageStatusEnum::New,
        ]);

        ContactMessage::query()->create([
            'name' => 'Sara Recruiter',
            'email' => 'sara@example.com',
            'phone' => '+201000000002',
            'subject' => 'CTO Interview',
            'message' => 'Following up on your portfolio.',
            'type' => ContactMessageTypeEnum::JobOffer,
            'status' => ContactMessageStatusEnum::Read,
            'read_at' => now(),
        ]);

        $response = $this->actingAs($this->superAdmin, 'admin')
            ->get('/en/admin');

        $response->assertOk();
        $response->assertViewIs('admin.index');
        $response->assertViewHas('stats', function (array $stats): bool {
            return $stats['projects_total'] === 1
                && $stats['projects_published'] === 1
                && $stats['technologies_total'] === 1
                && $stats['experiences_total'] === 1
                && $stats['blogs_total'] === 1
                && $stats['unread_messages'] === 1
                && $stats['total_messages'] === 2;
        });

        $response->assertViewHas('messagesMonthlyChart', function (array $chart): bool {
            return count($chart['labels']) === 6
                && count($chart['counts']) === 6
                && count($chart['series']) === 6;
        });

        $response->assertSee('dir="ltr"', false);
        $response->assertSee('dashboard-common.css', false);
        $response->assertSee('dashboard-ltr.css', false);
        $response->assertSee('Enterprise Project Suite');
        $response->assertSee('Ahmed Client');
        $response->assertSee('data-testid="sidebar-unread-messages-badge"', false);
    }

    /**
     * Ensure the dashboard renders in Arabic with RTL direction and RTL stylesheet.
     */
    public function test_dashboard_renders_arabic_rtl_layout_and_stylesheets(): void
    {
        $this->refreshApplicationWithLocale('ar');
        $this->seed(RoleSeeder::class);

        $arAdmin = User::factory()->create([
            'name' => 'Eng. Abdelrahman',
            'email' => 'ar-admin@abdelrahman.dev',
            'is_admin' => true,
        ]);
        $arAdmin->assignRole('Super admin');

        $response = $this->actingAs($arAdmin, 'admin')
            ->get('/ar/admin');

        $response->assertOk();
        $response->assertSee('lang="ar"', false);
        $response->assertSee('dir="rtl"', false);
        $response->assertSee('dashboard-common.css', false);
        $response->assertSee('dashboard-rtl.css', false);
        $response->assertSee('معرض الأعمال والخبرات');
        $response->assertSee('أحدث المشاريع');
        $response->assertSee('أحدث رسائل التواصل');
    }

    /**
     * Ensure the sidebar only displays navigation items that the authenticated admin has permission to view.
     */
    public function test_sidebar_only_displays_modules_permitted_for_restricted_admin(): void
    {
        $limitedRole = Role::query()->create([
            'name' => 'Portfolio Reviewer',
            'guard_name' => 'admin',
        ]);
        $limitedRole->givePermissionTo(['projects.view_all', 'messages.view_all']);

        $limitedAdmin = User::factory()->create([
            'name' => 'Limited Reviewer',
            'email' => 'reviewer@abdelrahman.dev',
            'is_admin' => true,
        ]);
        $limitedAdmin->assignRole($limitedRole);

        $response = $this->actingAs($limitedAdmin, 'admin')
            ->get('/en/admin');

        $response->assertOk();

        // Permitted links are visible
        $response->assertSee(route('admin.project.index'), false);
        $response->assertSee(route('admin.message.index'), false);

        // Unauthorized module links are hidden from sidebar
        $response->assertDontSee(route('admin.technology.index'), false);
        $response->assertDontSee(route('admin.experience.index'), false);
        $response->assertDontSee(route('admin.credential.index'), false);
        $response->assertDontSee(route('admin.service.index'), false);
        $response->assertDontSee(route('admin.blog.index'), false);
        $response->assertDontSee(route('admin.category.index'), false);
        $response->assertDontSee(route('admin.testimonial.index'), false);
        $response->assertDontSee(route('admin.faq.index'), false);
        $response->assertDontSee(route('admin.stat.index'), false);
        $response->assertDontSee(route('admin.all_settings.index'), false);
        $response->assertDontSee(route('admin.admin.index'), false);
        $response->assertDontSee(route('admin.role.index'), false);
    }
}
