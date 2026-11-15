<?php

/**
 * AdminPhase5BControllersTest
 *
 * Feature tests verifying Phase 5B:
 * - Thin Admin Controllers, ViewModels, and Metronic 8 Views for:
 *   Credentials, Services (via ServiceCatalogService), Testimonials, Categories,
 *   Blogs, FAQs, Stats, and ContactMessages.
 * - Verifies 403 authorization without permission, full CRUD, DataTables JSON,
 *   drag-and-drop reorder, ContactMessage auto-read on show & status/notes update,
 *   and FormRequest validation failure handling.
 */

declare(strict_types=1);

namespace Tests\Feature\Admin;

use App\Enums\BlogStatusEnum;
use App\Enums\ContactMessageStatusEnum;
use App\Enums\ContactMessageTypeEnum;
use App\Enums\CredentialTypeEnum;
use App\Models\Blog;
use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Credential;
use App\Models\Faq;
use App\Models\Project;
use App\Models\Service;
use App\Models\Stat;
use App\Models\Testimonial;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPhase5BControllersTest extends TestCase
{
    use RefreshDatabase;

    private User $superAdmin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->refreshApplicationWithLocale('en');
        $this->seed(RoleSeeder::class);

        $this->superAdmin = User::factory()->create(['is_admin' => true]);
        $this->superAdmin->assignRole('Super admin');
    }

    /**
     * Verify all 8 Phase 5B controllers return 403 Forbidden when an admin lacks permissions.
     */
    public function test_all_phase_5b_controllers_return_403_without_permission(): void
    {
        $unpermittedAdmin = User::factory()->create(['is_admin' => true]);

        $routes = [
            '/en/admin/credential',
            '/en/admin/service',
            '/en/admin/testimonial',
            '/en/admin/category',
            '/en/admin/blog',
            '/en/admin/faq',
            '/en/admin/stat',
            '/en/admin/message',
        ];

        foreach ($routes as $uri) {
            $this->actingAs($unpermittedAdmin, 'admin')
                ->get($uri)
                ->assertForbidden();
        }
    }

    /**
     * Verify full CRUD, DataTables JSON, and reorder lifecycle for CredentialController.
     */
    public function test_admin_credential_controller_crud_datatables_and_reorder(): void
    {
        $this->actingAs($this->superAdmin, 'admin')
            ->get('/en/admin/credential')
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->get('/en/admin/credential/create')
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->post('/en/admin/credential', [
                'title' => [
                    'ar' => 'بكالوريوس هندسة البرمجيات',
                    'en' => 'B.Sc. in Software Engineering',
                ],
                'organization' => [
                    'ar' => 'كلية الهندسة',
                    'en' => 'Faculty of Engineering',
                ],
                'description' => [
                    'ar' => 'تقدير امتياز مع مرتبة الشرف',
                    'en' => 'Graduated with Honors',
                ],
                'type' => CredentialTypeEnum::AcademicDegree->value,
                'issued_at' => '2021-06-15',
                'credential_id' => 'DEG-2021-001',
                'credential_url' => 'https://university.example.edu/verify/DEG-2021-001',
                'is_active' => '1',
            ])
            ->assertRedirect(route('admin.credential.index'));

        $credential = Credential::query()->firstOrFail();
        $this->assertSame(CredentialTypeEnum::AcademicDegree, $credential->type);

        $this->actingAs($this->superAdmin, 'admin')
            ->getJson('/en/admin/credential/table/show')
            ->assertOk()
            ->assertJsonStructure(['data', 'recordsTotal', 'recordsFiltered']);

        $this->actingAs($this->superAdmin, 'admin')
            ->get("/en/admin/credential/{$credential->id}")
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->get("/en/admin/credential/{$credential->id}/edit")
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->put("/en/admin/credential/{$credential->id}", [
                'title' => [
                    'ar' => 'شهادة هندسة Laravel المتقدمة',
                    'en' => 'Advanced Laravel Architecture Certificate',
                ],
                'organization' => [
                    'ar' => 'أكاديمية Laravel',
                    'en' => 'Laravel Academy',
                ],
                'type' => CredentialTypeEnum::ProfessionalCertificate->value,
                'issued_at' => '2023-05-10',
                'is_active' => '1',
            ])
            ->assertRedirect(route('admin.credential.index'));

        $this->assertSame(
            'Advanced Laravel Architecture Certificate',
            $credential->fresh()->getTranslation('title', 'en')
        );

        $credential2 = Credential::factory()->create(['sort_order' => 2]);
        $this->actingAs($this->superAdmin, 'admin')
            ->get('/en/admin/credential/reorder/credential')
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->postJson('/en/admin/credential/reorder/save', [
                'items' => [$credential2->id, $credential->id],
            ])
            ->assertOk()
            ->assertJsonPath('status', 'success');

        $this->assertSame(1, $credential2->fresh()->sort_order);
        $this->assertSame(2, $credential->fresh()->sort_order);

        $this->actingAs($this->superAdmin, 'admin')
            ->deleteJson("/en/admin/credential/{$credential2->id}")
            ->assertOk();

        $this->assertDatabaseMissing('credentials', ['id' => $credential2->id]);
    }

    /**
     * Verify full CRUD, DataTables JSON, and reorder lifecycle for ServiceController (via ServiceCatalogService).
     */
    public function test_admin_service_controller_crud_datatables_and_reorder(): void
    {
        $this->actingAs($this->superAdmin, 'admin')
            ->get('/en/admin/service')
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->get('/en/admin/service/create')
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->post('/en/admin/service', [
                'title' => [
                    'ar' => 'تطوير الأنظمة الخلفية بـ PHP Laravel',
                    'en' => 'PHP Laravel Backend Engineering',
                ],
                'subtitle' => [
                    'ar' => 'بنية نظيفة وأداء عالٍ',
                    'en' => 'Clean Architecture & High Performance',
                ],
                'short_description' => [
                    'ar' => 'بناء أنظمة وواجهات برمجية متكاملة',
                    'en' => 'Building scalable backend systems and RESTful APIs',
                ],
                'description' => [
                    'ar' => 'تفاصيل الخدمة الهندسية',
                    'en' => 'Detailed engineering service description',
                ],
                'icon' => 'fa-solid fa-server',
                'is_featured' => '1',
                'is_active' => '1',
            ])
            ->assertRedirect(route('admin.service.index'));

        $service = Service::query()->firstOrFail();
        $this->assertSame('php-laravel-backend-engineering', $service->slug);

        $this->actingAs($this->superAdmin, 'admin')
            ->getJson('/en/admin/service/table/show')
            ->assertOk()
            ->assertJsonStructure(['data']);

        $this->actingAs($this->superAdmin, 'admin')
            ->get("/en/admin/service/{$service->id}")
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->get("/en/admin/service/{$service->id}/edit")
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->put("/en/admin/service/{$service->id}", [
                'title' => [
                    'ar' => 'تطوير تطبيقات Full-Stack بـ Laravel & React',
                    'en' => 'Full-Stack Laravel & React.js Development',
                ],
                'short_description' => [
                    'ar' => 'حلول ويب متكاملة',
                    'en' => 'End-to-end web solutions',
                ],
                'description' => [
                    'ar' => 'تفاصيل الخدمة الهندسية المحدثة',
                    'en' => 'Updated detailed engineering service description',
                ],
                'icon' => 'fa-solid fa-code',
                'is_featured' => '1',
                'is_active' => '1',
            ])
            ->assertRedirect(route('admin.service.index'));

        $this->assertSame(
            'Full-Stack Laravel & React.js Development',
            $service->fresh()->getTranslation('title', 'en')
        );

        $service2 = Service::factory()->create(['sort_order' => 2]);
        $this->actingAs($this->superAdmin, 'admin')
            ->get('/en/admin/service/reorder/service')
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->postJson('/en/admin/service/reorder/save', [
                'items' => [$service2->id, $service->id],
            ])
            ->assertOk();

        $this->assertSame(1, $service2->fresh()->sort_order);

        $this->actingAs($this->superAdmin, 'admin')
            ->deleteJson("/en/admin/service/{$service2->id}")
            ->assertOk();

        $this->assertDatabaseMissing('services', ['id' => $service2->id]);
    }

    /**
     * Verify full CRUD, optional project link, rating, status, and reorder for TestimonialController.
     */
    public function test_admin_testimonial_controller_crud_project_link_and_reorder(): void
    {
        $project = Project::factory()->create();

        $this->actingAs($this->superAdmin, 'admin')
            ->get('/en/admin/testimonial')
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->get('/en/admin/testimonial/create')
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->post('/en/admin/testimonial', [
                'project_id' => $project->id,
                'name' => ['ar' => 'أحمد محمود', 'en' => 'Ahmed Mahmoud'],
                'name_job' => ['ar' => 'المدير التقني CTO', 'en' => 'Chief Technology Officer'],
                'company_name' => ['ar' => 'تك هب', 'en' => 'TechHub Inc.'],
                'description' => [
                    'ar' => 'قدم المهندس عبدالرحمن معمارية برمجية ممتازة والتزم بالمواعيد بدقة.',
                    'en' => 'Eng. Abdelrahman delivered an outstanding clean architecture on schedule.',
                ],
                'rating' => 5,
                'is_featured' => '1',
                'is_active' => '1',
            ])
            ->assertRedirect(route('admin.testimonial.index'));

        $testimonial = Testimonial::query()->firstOrFail();
        $this->assertSame($project->id, $testimonial->project_id);
        $this->assertSame(5, $testimonial->rating);

        $this->actingAs($this->superAdmin, 'admin')
            ->getJson('/en/admin/testimonial/table/show')
            ->assertOk()
            ->assertJsonStructure(['data']);

        $this->actingAs($this->superAdmin, 'admin')
            ->get("/en/admin/testimonial/{$testimonial->id}")
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->get("/en/admin/testimonial/{$testimonial->id}/edit")
            ->assertOk();

        // Update with null project_id and rating 4
        $this->actingAs($this->superAdmin, 'admin')
            ->put("/en/admin/testimonial/{$testimonial->id}", [
                'project_id' => null,
                'name' => ['ar' => 'أحمد محمود', 'en' => 'Ahmed Mahmoud'],
                'description' => [
                    'ar' => 'تجربة عمل احترافية للغاية.',
                    'en' => 'Highly professional engineering collaboration.',
                ],
                'rating' => 4,
                'is_featured' => '0',
                'is_active' => '1',
            ])
            ->assertRedirect(route('admin.testimonial.index'));

        $this->assertNull($testimonial->fresh()->project_id);
        $this->assertSame(4, $testimonial->fresh()->rating);

        $this->actingAs($this->superAdmin, 'admin')
            ->get('/en/admin/testimonial/reorder/testimonial')
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->postJson('/en/admin/testimonial/reorder/save', [
                'items' => [$testimonial->id],
            ])
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->deleteJson("/en/admin/testimonial/{$testimonial->id}")
            ->assertOk();

        $this->assertDatabaseMissing('testimonials', ['id' => $testimonial->id]);
    }

    /**
     * Verify full CRUD, DataTables JSON, and reorder lifecycle for CategoryController and BlogController.
     */
    public function test_admin_category_and_blog_controllers_crud_and_reorder(): void
    {
        // 1. Category CRUD
        $this->actingAs($this->superAdmin, 'admin')
            ->get('/en/admin/category')
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->get('/en/admin/category/create')
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->post('/en/admin/category', [
                'name' => ['ar' => 'هندسة البرمجيات', 'en' => 'Software Architecture'],
                'description' => ['ar' => 'مقالات معمارية', 'en' => 'Architecture articles'],
                'is_active' => '1',
            ])
            ->assertRedirect(route('admin.category.index'));

        $category = Category::query()->firstOrFail();
        $this->assertSame('software-architecture', $category->slug);

        $this->actingAs($this->superAdmin, 'admin')
            ->getJson('/en/admin/category/table/show')
            ->assertOk()
            ->assertJsonStructure(['data']);

        $this->actingAs($this->superAdmin, 'admin')
            ->get("/en/admin/category/{$category->id}")
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->get("/en/admin/category/{$category->id}/edit")
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->put("/en/admin/category/{$category->id}", [
                'name' => ['ar' => 'معمارية الأنظمة النظيفة', 'en' => 'Clean Architecture'],
                'is_active' => '1',
            ])
            ->assertRedirect(route('admin.category.index'));

        $this->actingAs($this->superAdmin, 'admin')
            ->get('/en/admin/category/reorder/category')
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->postJson('/en/admin/category/reorder/save', [
                'items' => [$category->id],
            ])
            ->assertOk();

        // 2. Blog CRUD (with ar/en tabs, category_id, BlogStatusEnum, published_at)
        $this->actingAs($this->superAdmin, 'admin')
            ->get('/en/admin/blog')
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->get('/en/admin/blog/create')
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->post('/en/admin/blog', [
                'category_id' => $category->id,
                'name' => [
                    'ar' => 'تطبيق مبادئ SOLID في Laravel 10',
                    'en' => 'Applying SOLID Principles in Laravel 10',
                ],
                'short_description' => [
                    'ar' => 'دليل عملي لتطبيق SOLID',
                    'en' => 'A practical guide to SOLID in Laravel',
                ],
                'description' => [
                    'ar' => 'شرح تفصيلي لكيفية بناء المستودعات والخدمات.',
                    'en' => 'Detailed walkthrough of Repositories and Services.',
                ],
                'status' => BlogStatusEnum::Published->value,
                'published_at' => '2026-01-15',
                'reading_time_minutes' => 8,
                'is_featured' => '1',
                'is_active' => '1',
            ])
            ->assertRedirect(route('admin.blog.index'));

        $blog = Blog::query()->firstOrFail();
        $this->assertSame(BlogStatusEnum::Published, $blog->status);
        $this->assertSame($category->id, $blog->category_id);

        $this->actingAs($this->superAdmin, 'admin')
            ->getJson('/en/admin/blog/table/show')
            ->assertOk()
            ->assertJsonStructure(['data']);

        $this->actingAs($this->superAdmin, 'admin')
            ->get("/en/admin/blog/{$blog->id}")
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->get("/en/admin/blog/{$blog->id}/edit")
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->put("/en/admin/blog/{$blog->id}", [
                'category_id' => $category->id,
                'name' => [
                    'ar' => 'تطبيق مبادئ SOLID في PHP 8.3',
                    'en' => 'Applying SOLID Principles in PHP 8.3',
                ],
                'short_description' => [
                    'ar' => 'دليل محدث',
                    'en' => 'Updated guide',
                ],
                'description' => [
                    'ar' => 'محتوى محدث بالكامل',
                    'en' => 'Fully updated article content',
                ],
                'status' => BlogStatusEnum::Draft->value,
                'published_at' => '2026-02-01',
                'reading_time_minutes' => 10,
                'is_featured' => '0',
                'is_active' => '1',
            ])
            ->assertRedirect(route('admin.blog.index'));

        $this->assertSame(BlogStatusEnum::Draft, $blog->fresh()->status);

        $this->actingAs($this->superAdmin, 'admin')
            ->get('/en/admin/blog/reorder/blog')
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->postJson('/en/admin/blog/reorder/save', [
                'items' => [$blog->id],
            ])
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->deleteJson("/en/admin/blog/{$blog->id}")
            ->assertOk();

        $this->assertDatabaseMissing('blogs', ['id' => $blog->id]);

        $this->actingAs($this->superAdmin, 'admin')
            ->deleteJson("/en/admin/category/{$category->id}")
            ->assertOk();

        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }

    /**
     * Verify full CRUD, DataTables JSON, and reorder lifecycle for FaqController and StatController.
     */
    public function test_admin_faq_and_stat_controllers_crud_and_reorder(): void
    {
        // 1. FAQ CRUD & Reorder
        $this->actingAs($this->superAdmin, 'admin')
            ->get('/en/admin/faq')
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->get('/en/admin/faq/create')
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->post('/en/admin/faq', [
                'question' => [
                    'ar' => 'ما هي التقنيات الأساسية التي تعمل بها؟',
                    'en' => 'What is your primary technical stack?',
                ],
                'answer' => [
                    'ar' => 'أعمل بشكل أساسي بـ PHP 8.3 و Laravel 10 و React.js.',
                    'en' => 'I specialize in PHP 8.3, Laravel 10, JavaScript ES6+, and React.js.',
                ],
                'is_active' => '1',
            ])
            ->assertRedirect(route('admin.faq.index'));

        $faq = Faq::query()->firstOrFail();

        $this->actingAs($this->superAdmin, 'admin')
            ->getJson('/en/admin/faq/table/show')
            ->assertOk()
            ->assertJsonStructure(['data']);

        $this->actingAs($this->superAdmin, 'admin')
            ->get("/en/admin/faq/{$faq->id}")
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->get("/en/admin/faq/{$faq->id}/edit")
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->put("/en/admin/faq/{$faq->id}", [
                'question' => [
                    'ar' => 'هل تتاح للعمل عن بعد؟',
                    'en' => 'Are you available for remote positions?',
                ],
                'answer' => [
                    'ar' => 'نعم، متاح للعمل الكامل أو العقود عن بعد.',
                    'en' => 'Yes, I am available for full-time or contract remote roles.',
                ],
                'is_active' => '1',
            ])
            ->assertRedirect(route('admin.faq.index'));

        $this->assertSame('Are you available for remote positions?', $faq->fresh()->getTranslation('question', 'en'));

        $this->actingAs($this->superAdmin, 'admin')
            ->get('/en/admin/faq/reorder/faq')
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->postJson('/en/admin/faq/reorder/save', [
                'items' => [$faq->id],
            ])
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->deleteJson("/en/admin/faq/{$faq->id}")
            ->assertOk();

        $this->assertDatabaseMissing('faqs', ['id' => $faq->id]);

        // 2. Stat CRUD & Reorder
        $this->actingAs($this->superAdmin, 'admin')
            ->get('/en/admin/stat')
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->get('/en/admin/stat/create')
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->post('/en/admin/stat', [
                'label' => [
                    'ar' => 'سنوات الخبرة العملية',
                    'en' => 'Years of Experience',
                ],
                'value' => '4',
                'prefix' => '+',
                'suffix' => '',
                'icon' => 'fa-solid fa-briefcase',
                'is_active' => '1',
            ])
            ->assertRedirect(route('admin.stat.index'));

        $stat = Stat::query()->firstOrFail();
        $this->assertSame('4', $stat->value);

        $this->actingAs($this->superAdmin, 'admin')
            ->getJson('/en/admin/stat/table/show')
            ->assertOk()
            ->assertJsonStructure(['data']);

        $this->actingAs($this->superAdmin, 'admin')
            ->get("/en/admin/stat/{$stat->id}")
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->get("/en/admin/stat/{$stat->id}/edit")
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->put("/en/admin/stat/{$stat->id}", [
                'label' => [
                    'ar' => 'مشاريع ناجحة',
                    'en' => 'Completed Projects',
                ],
                'value' => '25',
                'prefix' => '',
                'suffix' => '+',
                'icon' => 'fa-solid fa-diagram-project',
                'is_active' => '1',
            ])
            ->assertRedirect(route('admin.stat.index'));

        $this->assertSame('25', $stat->fresh()->value);

        $this->actingAs($this->superAdmin, 'admin')
            ->get('/en/admin/stat/reorder/stat')
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->postJson('/en/admin/stat/reorder/save', [
                'items' => [$stat->id],
            ])
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->deleteJson("/en/admin/stat/{$stat->id}")
            ->assertOk();

        $this->assertDatabaseMissing('stats', ['id' => $stat->id]);
    }

    /**
     * Verify MessageController read-only listing, filters, auto-read on show, status/admin_notes update, and delete.
     */
    public function test_admin_message_controller_auto_marks_read_updates_status_and_filters(): void
    {
        $unreadMessage = ContactMessage::factory()->create([
            'type' => ContactMessageTypeEnum::ProjectInquiry,
            'status' => ContactMessageStatusEnum::New,
            'read_at' => null,
        ]);

        ContactMessage::factory()->create([
            'type' => ContactMessageTypeEnum::JobOffer,
            'status' => ContactMessageStatusEnum::Archived,
        ]);

        // 1. Index page
        $this->actingAs($this->superAdmin, 'admin')
            ->get('/en/admin/message')
            ->assertOk();

        // 2. DataTables JSON with type and status filters
        $tableResponse = $this->actingAs($this->superAdmin, 'admin')
            ->getJson('/en/admin/message/table/show?type='.ContactMessageTypeEnum::ProjectInquiry->value.'&status='.ContactMessageStatusEnum::New->value)
            ->assertOk();

        $this->assertSame(1, $tableResponse->json('recordsFiltered'));

        // 3. Opening show page automatically marks New message as Read and populates read_at
        $this->actingAs($this->superAdmin, 'admin')
            ->get("/en/admin/message/{$unreadMessage->id}")
            ->assertOk();

        $unreadMessage->refresh();
        $this->assertSame(ContactMessageStatusEnum::Read, $unreadMessage->status);
        $this->assertNotNull($unreadMessage->read_at);

        // 4. Updating status to Replied and saving admin_notes
        $this->actingAs($this->superAdmin, 'admin')
            ->put("/en/admin/message/{$unreadMessage->id}", [
                'status' => ContactMessageStatusEnum::Replied->value,
                'admin_notes' => 'Scheduled technical discovery call with the client.',
            ])
            ->assertRedirect(route('admin.message.show', $unreadMessage->id));

        $unreadMessage->refresh();
        $this->assertSame(ContactMessageStatusEnum::Replied, $unreadMessage->status);
        $this->assertSame('Scheduled technical discovery call with the client.', $unreadMessage->admin_notes);

        // 5. Destroy message
        $this->actingAs($this->superAdmin, 'admin')
            ->deleteJson("/en/admin/message/{$unreadMessage->id}")
            ->assertOk()
            ->assertJsonPath('status', 'success');

        $this->assertDatabaseMissing('contact_messages', ['id' => $unreadMessage->id]);
    }

    /**
     * Verify FormRequest validation failures across Phase 5B controllers.
     */
    public function test_phase_5b_controllers_enforce_form_request_validation(): void
    {
        // Credential missing required bilingual title, organization & type
        $this->actingAs($this->superAdmin, 'admin')
            ->post('/en/admin/credential', [])
            ->assertSessionHasErrors(['title.ar', 'title.en', 'organization.ar', 'organization.en', 'type', 'issued_at']);

        // Service missing required title, short_description & description
        $this->actingAs($this->superAdmin, 'admin')
            ->post('/en/admin/service', [])
            ->assertSessionHasErrors(['title.ar', 'title.en', 'short_description.ar', 'short_description.en', 'description.ar', 'description.en']);

        // Testimonial invalid rating (out of 1..5 range) and missing name & description
        $this->actingAs($this->superAdmin, 'admin')
            ->post('/en/admin/testimonial', [
                'rating' => 10,
            ])
            ->assertSessionHasErrors(['name.ar', 'name.en', 'description.ar', 'description.en', 'rating']);

        // Blog invalid status enum and missing name & description
        $this->actingAs($this->superAdmin, 'admin')
            ->post('/en/admin/blog', [
                'status' => 'invalid_status',
            ])
            ->assertSessionHasErrors(['name.ar', 'name.en', 'description.ar', 'description.en', 'status']);

        // ContactMessage invalid status enum on update
        $message = ContactMessage::factory()->create();
        $this->actingAs($this->superAdmin, 'admin')
            ->put("/en/admin/message/{$message->id}", [
                'status' => 'not_a_valid_status',
            ])
            ->assertSessionHasErrors(['status']);
    }
}
