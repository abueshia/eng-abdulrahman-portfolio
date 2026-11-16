<?php

/**
 * PublicPortfolioApiTest
 *
 * Comprehensive Feature test suite for Phase 6A Public REST API (/api/v1/*):
 * - Standardized ApiResponseTrait envelope (`code`, `success`, `message`, `data`, `pagination`)
 * - Bilingual localization (`Accept-Language` and `?lang=ar|en`)
 * - Public settings & section visibility flags
 * - Aggregated `/api/v1/home` endpoint
 * - Projects filtering (`type`, `category`, `technology`), pagination, slug lookup & 404
 * - Technologies (grouped), Experiences, Credentials, Services, Testimonials, FAQs, Stats
 * - Blogs list, categories, slug detail, view counter increment & 404
 * - Contact submission (`POST /api/v1/contact`), validation, honeypot, sensitive data exclusion & rate limiting
 * - HTTP caching (`ETag`, `Cache-Control`, `304 Not Modified`) and CORS headers (`https://eng-abdulrahman-abu-eisha.vercel.app`, `http://localhost:5173`)
 */

declare(strict_types=1);

namespace Tests\Feature\API;

use App\DTOs\SettingUpdateData;
use App\Enums\BlogStatusEnum;
use App\Enums\CredentialTypeEnum;
use App\Enums\EmploymentTypeEnum;
use App\Enums\ProjectStatusEnum;
use App\Enums\ProjectTypeEnum;
use App\Enums\SettingKeyEnum;
use App\Enums\TechnologyCategoryEnum;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Credential;
use App\Models\Experience;
use App\Models\Faq;
use App\Models\Project;
use App\Models\Service;
use App\Models\Stat;
use App\Models\Technology;
use App\Models\Testimonial;
use App\Services\SettingService;
use Database\Seeders\SettingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\RateLimiter;
use Tests\TestCase;

class PublicPortfolioApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(SettingSeeder::class);
    }

    /**
     * Verify /api/v1/settings returns localized public settings, ETag caching, and respects section visibility.
     */
    public function test_settings_endpoint_returns_localized_public_settings_and_respects_section_visibility(): void
    {
        $enResponse = $this->withHeaders(['Accept-Language' => 'en'])
            ->getJson('/api/v1/settings');

        $enResponse->assertOk()
            ->assertJsonStructure([
                'code',
                'success',
                'message',
                'data' => [
                    'locale',
                    'general',
                    'seo',
                    'sections_visibility',
                    'hero',
                    'about',
                    'contact',
                    'cta',
                ],
            ])
            ->assertJsonPath('code', 200)
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.locale', 'en')
            ->assertJsonPath('data.general.owner_name', 'Eng. Abdelrahman Abu Aishah');

        $etag = $enResponse->headers->get('ETag');
        $this->assertNotEmpty($etag);
        $this->assertStringContainsString('public', (string) $enResponse->headers->get('Cache-Control'));

        // Conditional request with matching ETag returns 304 Not Modified
        $notModified = $this->withHeaders([
            'Accept-Language' => 'en',
            'If-None-Match' => (string) $etag,
        ])->get('/api/v1/settings');
        $notModified->assertStatus(304);

        // Query parameter ?lang=ar overrides header and returns Arabic values
        $arResponse = $this->getJson('/api/v1/settings?lang=ar');
        $arResponse->assertOk()
            ->assertJsonPath('data.locale', 'ar')
            ->assertJsonPath('data.general.owner_name', 'مهندس / عبدالرحمن أبو عيشة');

        // Disable hero section visibility and verify data.hero becomes null
        app(SettingService::class)->updateSettings(new SettingUpdateData(
            settings: [SettingKeyEnum::ShowHeroSection->value => false],
            files: [],
        ));

        $updatedResponse = $this->getJson('/api/v1/settings?lang=en');
        $updatedResponse->assertOk()
            ->assertJsonPath('data.sections_visibility.show_hero_section', false)
            ->assertJsonPath('data.hero', null);
    }

    /**
     * Verify /api/v1/home returns aggregated landing page data and respects section visibility flags.
     */
    public function test_home_endpoint_returns_aggregated_portfolio_payload_and_respects_visibility(): void
    {
        $this->seedSamplePortfolioContent();

        $response = $this->getJson('/api/v1/home?lang=ar');

        $response->assertOk()
            ->assertJsonPath('code', 200)
            ->assertJsonPath('success', true)
            ->assertJsonStructure([
                'code',
                'success',
                'message',
                'data' => [
                    'settings',
                    'stats',
                    'services',
                    'featured_projects',
                    'technologies',
                    'experiences',
                    'credentials',
                    'testimonials',
                    'latest_blogs',
                    'faqs',
                ],
            ])
            ->assertJsonPath('data.featured_projects.0.title', 'منصة سحابية لإدارة الموارد')
            ->assertJsonPath('data.stats.0.label', 'سنوات الخبرة');

        // Turn off stats section visibility and verify home returns empty stats array
        app(SettingService::class)->updateSettings(new SettingUpdateData(
            settings: [SettingKeyEnum::ShowStatsSection->value => false],
            files: [],
        ));

        $afterToggle = $this->getJson('/api/v1/home?lang=en');
        $afterToggle->assertOk()
            ->assertJsonPath('data.stats', [])
            ->assertJsonPath('data.featured_projects.0.title', 'Enterprise Cloud ERP Platform');
    }

    /**
     * Verify /api/v1/projects filtering, pagination structure, slug detail view, and 404 for drafts/missing.
     */
    public function test_projects_index_filtering_pagination_and_show_by_slug_and_404(): void
    {
        ['category' => $category, 'tech' => $tech, 'publishedProject' => $publishedProject] = $this->seedSamplePortfolioContent();

        // Draft project must never appear in public endpoints
        Project::query()->create([
            'category_id' => $category->id,
            'title' => ['ar' => 'مشروع مسودة', 'en' => 'Draft Internal Project'],
            'slug' => 'draft-internal-project',
            'short_description' => ['ar' => 'مسودة', 'en' => 'Draft'],
            'description' => ['ar' => 'مسودة', 'en' => 'Draft'],
            'project_type' => ProjectTypeEnum::ApiBackend,
            'status' => ProjectStatusEnum::Draft,
            'is_featured' => false,
            'is_active' => true,
            'sort_order' => 2,
        ]);

        $listResponse = $this->getJson('/api/v1/projects?lang=en&per_page=5');

        $listResponse->assertOk()
            ->assertJsonStructure([
                'code',
                'success',
                'message',
                'pagination' => [
                    'current_page',
                    'first_page_url',
                    'prev_page_url',
                    'next_page_url',
                    'last_page_url',
                    'total_pages',
                    'per_page',
                    'total_items',
                    'path',
                ],
                'data',
            ])
            ->assertJsonPath('pagination.total_items', 1)
            ->assertJsonPath('data.0.slug', $publishedProject->slug)
            ->assertJsonPath('data.0.title', 'Enterprise Cloud ERP Platform');

        // Filter by project type, category slug, and technology slug
        $filtered = $this->getJson("/api/v1/projects?type=saas&category={$category->slug}&technology={$tech->slug}");
        $filtered->assertOk()->assertJsonPath('pagination.total_items', 1);

        $emptyFilter = $this->getJson('/api/v1/projects?type=ecommerce');
        $emptyFilter->assertOk()->assertJsonPath('pagination.total_items', 0);

        // Show by slug (published)
        $detailResponse = $this->getJson("/api/v1/projects/{$publishedProject->slug}?lang=ar");
        $detailResponse->assertOk()
            ->assertJsonPath('code', 200)
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.slug', $publishedProject->slug)
            ->assertJsonPath('data.title', 'منصة سحابية لإدارة الموارد')
            ->assertJsonStructure(['data' => ['id', 'title', 'slug', 'technologies', 'category', 'related_projects']]);

        // Show draft or non-existent slug returns 404
        $this->getJson('/api/v1/projects/draft-internal-project')
            ->assertStatus(404)
            ->assertJsonPath('code', 404)
            ->assertJsonPath('success', false);

        $this->getJson('/api/v1/projects/non-existent-slug')
            ->assertStatus(404)
            ->assertJsonPath('code', 404)
            ->assertJsonPath('success', false);
    }

    /**
     * Verify technologies, experiences, credentials, services, testimonials, faqs, and stats endpoints.
     */
    public function test_technologies_experiences_credentials_services_testimonials_faqs_and_stats_endpoints(): void
    {
        $this->seedSamplePortfolioContent();

        $this->getJson('/api/v1/technologies?lang=en')
            ->assertOk()
            ->assertJsonPath('code', 200)
            ->assertJsonPath('data.backend.category', 'backend')
            ->assertJsonPath('data.backend.items.0.name', 'Laravel 10');

        $this->getJson('/api/v1/technologies?category=backend&lang=ar')
            ->assertOk()
            ->assertJsonPath('data.backend.items.0.name', 'لارافيل 10');

        $this->getJson('/api/v1/experiences?lang=en')
            ->assertOk()
            ->assertJsonPath('data.0.company_name', 'Acme Cloud Corp')
            ->assertJsonPath('data.0.technologies.0.slug', 'laravel-10');

        $this->getJson('/api/v1/credentials?type=academic_degree&lang=en')
            ->assertOk()
            ->assertJsonPath('data.0.title', 'B.Sc. in Computer Science');

        $this->getJson('/api/v1/services?lang=en')
            ->assertOk()
            ->assertJsonPath('data.0.title', 'Backend API Architecture');

        $this->getJson('/api/v1/testimonials?lang=en')
            ->assertOk()
            ->assertJsonPath('data.0.client_name', 'John CTO')
            ->assertJsonPath('data.0.project.slug', 'enterprise-cloud-erp');

        $this->getJson('/api/v1/faqs?lang=ar')
            ->assertOk()
            ->assertJsonPath('data.0.question', 'ما هي التقنيات التي تعتمد عليها؟');

        $this->getJson('/api/v1/stats?lang=en')
            ->assertOk()
            ->assertJsonPath('data.0.label', 'Years of Experience')
            ->assertJsonPath('data.0.value', '4');
    }

    /**
     * Verify blogs list, categories, show by slug, view counter increment, and 404 handling.
     */
    public function test_blogs_index_categories_show_by_slug_view_increment_and_404(): void
    {
        ['category' => $category, 'publishedBlog' => $publishedBlog] = $this->seedSamplePortfolioContent();

        // Draft blog must not be exposed
        Blog::query()->create([
            'category_id' => $category->id,
            'name' => ['ar' => 'مسودة مقال', 'en' => 'Draft Article'],
            'slug' => 'draft-article',
            'short_description' => ['ar' => 'وصف', 'en' => 'Short'],
            'description' => ['ar' => 'محتوى', 'en' => 'Body'],
            'status' => BlogStatusEnum::Draft,
            'sort_order' => 2,
        ]);

        $this->getJson("/api/v1/blogs?category={$category->slug}&lang=en")
            ->assertOk()
            ->assertJsonPath('pagination.total_items', 1)
            ->assertJsonPath('data.0.slug', $publishedBlog->slug);

        $this->getJson('/api/v1/blogs/categories?lang=en')
            ->assertOk()
            ->assertJsonPath('data.0.slug', $category->slug)
            ->assertJsonPath('data.0.blogs_count', 1);

        $detail = $this->getJson("/api/v1/blogs/{$publishedBlog->slug}?lang=en");
        $detail->assertOk()
            ->assertJsonPath('data.slug', $publishedBlog->slug)
            ->assertJsonPath('data.title', 'Clean Architecture in Laravel 10');

        $this->assertSame(1, $publishedBlog->fresh()?->views_count);

        $this->getJson('/api/v1/blogs/draft-article')
            ->assertStatus(404)
            ->assertJsonPath('code', 404)
            ->assertJsonPath('success', false);
    }

    /**
     * Verify POST /api/v1/contact validation, honeypot protection, sensitive data exclusion, and rate limiting.
     */
    public function test_contact_submission_validation_honeypot_sensitive_fields_exclusion_and_rate_limiting(): void
    {
        RateLimiter::clear('5');

        // 1. Validation error (missing required email & message)
        $invalidResponse = $this->postJson('/api/v1/contact?lang=en', [
            'name' => 'Eng. Visitor',
        ]);

        $invalidResponse->assertStatus(422)
            ->assertJsonPath('code', 422)
            ->assertJsonPath('success', false)
            ->assertJsonStructure(['code', 'success', 'message', 'errors' => ['email', 'message']]);

        // 2. Honeypot field filled -> rejected with 422
        $honeypotResponse = $this->postJson('/api/v1/contact', [
            'name' => 'Spam Bot',
            'email' => 'bot@spam.test',
            'message' => 'Automated spam',
            'website' => 'https://spambot.example.com',
        ]);
        $honeypotResponse->assertStatus(422)
            ->assertJsonPath('success', false);

        // 3. Valid contact submission -> 201 Created, sensitive fields excluded from response
        $validResponse = $this->postJson('/api/v1/contact?lang=en', [
            'name' => 'Tech Founder',
            'email' => 'founder@startup.io',
            'phone' => '+201012345678',
            'subject' => 'Full-Stack Architecture Consultation',
            'service' => 'Backend API Architecture',
            'budget_range' => '$5,000 - $10,000',
            'timeline' => '2 Months',
            'type' => 'project_inquiry',
            'message' => 'We would love to hire you for our SaaS platform.',
        ]);

        $validResponse->assertCreated()
            ->assertJsonPath('code', 201)
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.name', 'Tech Founder')
            ->assertJsonPath('data.type', 'project_inquiry')
            ->assertJsonMissingPath('data.admin_notes')
            ->assertJsonMissingPath('data.ip_address')
            ->assertJsonMissingPath('data.user_agent');

        $this->assertDatabaseHas('contact_messages', [
            'email' => 'founder@startup.io',
            'type' => 'project_inquiry',
        ]);

        // 4. Rate Limiting (throttle:5,1 allows 5 requests per minute; the 6th must return 429)
        for ($i = 0; $i < 3; $i++) {
            $this->postJson('/api/v1/contact', [
                'name' => "Caller {$i}",
                'email' => "caller{$i}@startup.io",
                'message' => 'Testing rate limit.',
            ]);
        }

        $throttledResponse = $this->postJson('/api/v1/contact', [
            'name' => 'Rate Limited Caller',
            'email' => 'limited@startup.io',
            'message' => 'Should hit 429.',
        ]);

        $throttledResponse->assertStatus(429);
    }

    /**
     * Verify CORS configuration allows the production Vercel domain and localhost:5173.
     */
    public function test_cors_headers_allow_vercel_frontend_and_localhost_5173(): void
    {
        $vercelResponse = $this->withHeaders([
            'Origin' => 'https://eng-abdulrahman-abu-eisha.vercel.app',
        ])->getJson('/api/v1/settings');

        $vercelResponse->assertOk()
            ->assertHeader('Access-Control-Allow-Origin', 'https://eng-abdulrahman-abu-eisha.vercel.app');

        $localResponse = $this->withHeaders([
            'Origin' => 'http://localhost:5173',
        ])->getJson('/api/v1/settings');

        $localResponse->assertOk()
            ->assertHeader('Access-Control-Allow-Origin', 'http://localhost:5173');
    }

    /**
     * Seed a complete set of active/published portfolio records for API verification.
     *
     * @return array{category: Category, tech: Technology, publishedProject: Project, publishedBlog: Blog}
     */
    private function seedSamplePortfolioContent(): array
    {
        $category = Category::query()->create([
            'name' => ['ar' => 'تطبيقات المؤسسات', 'en' => 'Enterprise Apps'],
            'slug' => 'enterprise-apps',
            'description' => ['ar' => 'أنظمة مؤسسية', 'en' => 'Enterprise platforms'],
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $tech = Technology::query()->create([
            'name' => ['ar' => 'لارافيل 10', 'en' => 'Laravel 10'],
            'slug' => 'laravel-10',
            'category' => TechnologyCategoryEnum::Backend,
            'proficiency_percent' => 96,
            'years_experience' => 4,
            'is_featured' => true,
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $publishedProject = Project::query()->create([
            'category_id' => $category->id,
            'title' => ['ar' => 'منصة سحابية لإدارة الموارد', 'en' => 'Enterprise Cloud ERP Platform'],
            'subtitle' => ['ar' => 'نظام متكامل', 'en' => 'Multi-tenant SaaS'],
            'slug' => 'enterprise-cloud-erp',
            'short_description' => ['ar' => 'وصف مختصر للمشروع', 'en' => 'Short ERP summary'],
            'description' => ['ar' => 'وصف تفصيلي للمشروع', 'en' => 'Detailed ERP case study'],
            'project_type' => ProjectTypeEnum::Saas,
            'status' => ProjectStatusEnum::Published,
            'live_url' => 'https://erp.example.com',
            'repo_url' => 'https://github.com/abdelrahman/erp',
            'is_featured' => true,
            'is_active' => true,
            'sort_order' => 1,
        ]);
        $publishedProject->technologies()->sync([$tech->id => ['sort_order' => 1]]);

        $experience = Experience::query()->create([
            'company_name' => ['ar' => 'شركة أكمي السحابية', 'en' => 'Acme Cloud Corp'],
            'role_title' => ['ar' => 'مهندس برمجيات أول', 'en' => 'Senior Full-Stack Engineer'],
            'location' => ['ar' => 'القاهرة، مصر', 'en' => 'Cairo, Egypt'],
            'summary' => ['ar' => 'قيادة تطوير الأنظمة', 'en' => 'Leading full-stack architecture'],
            'employment_type' => EmploymentTypeEnum::FullTime,
            'start_date' => '2022-01-01',
            'is_current' => true,
            'is_active' => true,
            'sort_order' => 1,
        ]);
        $experience->technologies()->sync([$tech->id]);

        Credential::query()->create([
            'title' => ['ar' => 'بكالوريوس علوم الحاسب', 'en' => 'B.Sc. in Computer Science'],
            'organization' => ['ar' => 'كلية الحاسبات والمعلومات', 'en' => 'Faculty of Computers & AI'],
            'type' => CredentialTypeEnum::AcademicDegree,
            'issued_at' => '2021-07-01',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        Service::query()->create([
            'title' => ['ar' => 'هندسة الواجهات الخلفية وواجهات الـ API', 'en' => 'Backend API Architecture'],
            'slug' => 'backend-api-architecture',
            'short_description' => ['ar' => 'تصميم وبناء REST APIs', 'en' => 'Designing scalable REST APIs'],
            'description' => ['ar' => 'تفاصيل الخدمة', 'en' => 'Full service details'],
            'is_featured' => true,
            'is_active' => true,
            'sort_order' => 1,
        ]);

        Testimonial::query()->create([
            'project_id' => $publishedProject->id,
            'name' => ['ar' => 'جون المدير التقني', 'en' => 'John CTO'],
            'name_job' => ['ar' => 'المدير التقني', 'en' => 'Chief Technology Officer'],
            'company_name' => ['ar' => 'أكمي', 'en' => 'Acme Inc.'],
            'description' => ['ar' => 'مهندس متميز والتزام عالي بالجودة', 'en' => 'Outstanding architectural quality and delivery.'],
            'rating' => 5,
            'is_featured' => true,
            'status' => true,
            'sort_order' => 1,
        ]);

        $publishedBlog = Blog::query()->create([
            'category_id' => $category->id,
            'name' => ['ar' => 'المعمارية النظيفة في لارافيل 10', 'en' => 'Clean Architecture in Laravel 10'],
            'slug' => 'clean-architecture-in-laravel-10',
            'short_description' => ['ar' => 'ملخص المقال', 'en' => 'Article summary'],
            'description' => ['ar' => 'محتوى المقال الكامل', 'en' => 'Full article content'],
            'status' => BlogStatusEnum::Published,
            'published_at' => now()->subDay(),
            'reading_time_minutes' => 6,
            'views_count' => 0,
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        Faq::query()->create([
            'question' => ['ar' => 'ما هي التقنيات التي تعتمد عليها؟', 'en' => 'What is your primary tech stack?'],
            'answer' => ['ar' => 'PHP 8.3 و Laravel 10 و React.js', 'en' => 'PHP 8.3, Laravel 10, and React.js'],
            'is_active' => true,
            'sort_order' => 1,
        ]);

        Stat::query()->create([
            'label' => ['ar' => 'سنوات الخبرة', 'en' => 'Years of Experience'],
            'value' => '4',
            'prefix' => '+',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        return [
            'category' => $category,
            'tech' => $tech,
            'publishedProject' => $publishedProject,
            'publishedBlog' => $publishedBlog,
        ];
    }
}
