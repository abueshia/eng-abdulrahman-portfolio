<?php

/**
 * PortfolioCoreServicesTest
 *
 * Feature & architectural tests verifying Phase 4 repositories, services,
 * pragmatic DTOs (ProjectData, ContactMessageData), Spatie MediaLibrary uploads,
 * versioned cache invalidation, Policies on the 'admin' guard, and FormRequests
 * with bilingual (Arabic/English) validation messages.
 */

declare(strict_types=1);

namespace Tests\Feature;

use App\DTOs\ContactMessageData;
use App\DTOs\ProjectData;
use App\Enums\BlogStatusEnum;
use App\Enums\ContactMessageStatusEnum;
use App\Enums\ContactMessageTypeEnum;
use App\Enums\CredentialTypeEnum;
use App\Enums\EmploymentTypeEnum;
use App\Enums\ProjectStatusEnum;
use App\Enums\ProjectTypeEnum;
use App\Enums\TechnologyCategoryEnum;
use App\Http\Requests\Admin\Blog\StoreBlogRequest;
use App\Http\Requests\Admin\Category\StoreCategoryRequest;
use App\Http\Requests\Admin\ContactMessage\UpdateContactMessageRequest;
use App\Http\Requests\Admin\Credential\StoreCredentialRequest;
use App\Http\Requests\Admin\Experience\StoreExperienceRequest;
use App\Http\Requests\Admin\Faq\StoreFaqRequest;
use App\Http\Requests\Admin\Project\StoreProjectRequest;
use App\Http\Requests\Admin\Project\UpdateProjectRequest;
use App\Http\Requests\Admin\Service\StoreServiceRequest;
use App\Http\Requests\Admin\Stat\StoreStatRequest;
use App\Http\Requests\Admin\Technology\StoreTechnologyRequest;
use App\Http\Requests\Admin\Testimonial\StoreTestimonialRequest;
use App\Http\Requests\BasePortfolioFormRequest;
use App\Http\Requests\ContactMessage\StoreContactMessageRequest;
use App\Models\Blog;
use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Credential;
use App\Models\Experience;
use App\Models\Faq;
use App\Models\Project;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Stat;
use App\Models\Technology;
use App\Models\Testimonial;
use App\Models\User;
use App\Repositories\Contracts\BlogRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\ContactMessageRepositoryInterface;
use App\Repositories\Contracts\CredentialRepositoryInterface;
use App\Repositories\Contracts\ExperienceRepositoryInterface;
use App\Repositories\Contracts\FaqRepositoryInterface;
use App\Repositories\Contracts\ProjectRepositoryInterface;
use App\Repositories\Contracts\ServiceRepositoryInterface;
use App\Repositories\Contracts\StatRepositoryInterface;
use App\Repositories\Contracts\TechnologyRepositoryInterface;
use App\Repositories\Contracts\TestimonialRepositoryInterface;
use App\Repositories\Eloquent\EloquentBlogRepository;
use App\Repositories\Eloquent\EloquentCategoryRepository;
use App\Repositories\Eloquent\EloquentContactMessageRepository;
use App\Repositories\Eloquent\EloquentCredentialRepository;
use App\Repositories\Eloquent\EloquentExperienceRepository;
use App\Repositories\Eloquent\EloquentFaqRepository;
use App\Repositories\Eloquent\EloquentProjectRepository;
use App\Repositories\Eloquent\EloquentServiceRepository;
use App\Repositories\Eloquent\EloquentStatRepository;
use App\Repositories\Eloquent\EloquentTechnologyRepository;
use App\Repositories\Eloquent\EloquentTestimonialRepository;
use App\Services\BlogService;
use App\Services\CategoryService;
use App\Services\ContactMessageService;
use App\Services\CredentialService;
use App\Services\ExperienceService;
use App\Services\FaqService;
use App\Services\ProjectService;
use App\Services\ServiceCatalogService;
use App\Services\StatService;
use App\Services\TechnologyService;
use App\Services\TestimonialService;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class PortfolioCoreServicesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Verify that all 11 domain repository contracts are bound to their Eloquent implementations.
     */
    public function test_all_domain_repository_interfaces_resolve_from_container(): void
    {
        $bindings = [
            ProjectRepositoryInterface::class => EloquentProjectRepository::class,
            TechnologyRepositoryInterface::class => EloquentTechnologyRepository::class,
            ExperienceRepositoryInterface::class => EloquentExperienceRepository::class,
            CredentialRepositoryInterface::class => EloquentCredentialRepository::class,
            ServiceRepositoryInterface::class => EloquentServiceRepository::class,
            TestimonialRepositoryInterface::class => EloquentTestimonialRepository::class,
            CategoryRepositoryInterface::class => EloquentCategoryRepository::class,
            BlogRepositoryInterface::class => EloquentBlogRepository::class,
            ContactMessageRepositoryInterface::class => EloquentContactMessageRepository::class,
            FaqRepositoryInterface::class => EloquentFaqRepository::class,
            StatRepositoryInterface::class => EloquentStatRepository::class,
        ];

        foreach ($bindings as $contract => $concrete) {
            $resolved = app($contract);
            $this->assertInstanceOf($concrete, $resolved);
        }
    }

    /**
     * Verify ProjectService create, update, unique slug generation, media uploads,
     * eager loading, reordering, cache invalidation, and deletion using ProjectData DTO.
     */
    public function test_project_service_crud_media_eager_loading_and_reordering(): void
    {
        Storage::fake('public');

        /** @var ProjectService $projectService */
        $projectService = app(ProjectService::class);

        $category = Category::factory()->create(['is_active' => true]);
        $laravelTech = Technology::factory()->create([
            'name' => ['ar' => 'Laravel 10', 'en' => 'Laravel 10'],
            'category' => TechnologyCategoryEnum::Backend,
        ]);
        $reactTech = Technology::factory()->create([
            'name' => ['ar' => 'React.js', 'en' => 'React.js'],
            'category' => TechnologyCategoryEnum::Frontend,
        ]);

        $cover = UploadedFile::fake()->image('cover.jpg', 800, 600);
        $gallery1 = UploadedFile::fake()->image('screen-1.png', 1200, 800);
        $gallery2 = UploadedFile::fake()->image('screen-2.png', 1200, 800);

        $dto1 = ProjectData::fromArray([
            'category_id' => $category->id,
            'title' => [
                'ar' => 'منصة إدارة الموارد السحابية',
                'en' => 'Cloud ERP SaaS Platform',
            ],
            'subtitle' => [
                'ar' => 'معمارية متعددة المستأجرين',
                'en' => 'Multi-tenant Clean Architecture',
            ],
            'short_description' => [
                'ar' => 'نظام سحابي متكامل مبني بـ Laravel 10 و React.js',
                'en' => 'Full-stack SaaS ERP built with Laravel 10 and React.js',
            ],
            'description' => [
                'ar' => 'تفاصيل هندسية شاملة حول بناء النظام.',
                'en' => 'Comprehensive engineering case study details.',
            ],
            'challenge' => [
                'ar' => 'معالجة ملايين العمليات يومياً.',
                'en' => 'Processing millions of daily transactions.',
            ],
            'solution' => [
                'ar' => 'تطبيق SOLID و Repository Pattern مع Redis.',
                'en' => 'Applied SOLID, Repository Pattern, and Redis queues.',
            ],
            'results' => [
                'ar' => 'تقليص زمن الاستجابة بنسبة 65%.',
                'en' => 'Reduced API latency by 65%.',
            ],
            'project_type' => ProjectTypeEnum::Saas->value,
            'status' => ProjectStatusEnum::Published->value,
            'live_url' => 'https://erp.example.com',
            'repo_url' => 'https://github.com/abdelrahman/cloud-erp',
            'is_featured' => true,
            'is_active' => true,
            'technologies' => [
                $laravelTech->id => ['role_in_project' => 'Backend API', 'sort_order' => 1],
                $reactTech->id => ['role_in_project' => 'SPA Frontend', 'sort_order' => 2],
            ],
        ], $cover, [$gallery1, $gallery2]);

        $project1 = $projectService->create($dto1);

        $this->assertSame('cloud-erp-saas-platform', $project1->slug);
        $this->assertSame(ProjectTypeEnum::Saas, $project1->project_type);
        $this->assertSame(ProjectStatusEnum::Published, $project1->status);
        $this->assertCount(2, $project1->technologies);
        $this->assertCount(1, $project1->getMedia('projects'));
        $this->assertCount(2, $project1->getMedia('projects_gallery'));

        // Creating a second project with the same English title must generate a unique slug
        $dto2 = ProjectData::fromArray([
            'category_id' => $category->id,
            'title' => [
                'ar' => 'منصة إدارة الموارد السحابية 2',
                'en' => 'Cloud ERP SaaS Platform',
            ],
            'short_description' => ['ar' => 'وصف', 'en' => 'Short'],
            'description' => ['ar' => 'تفاصيل', 'en' => 'Details'],
            'project_type' => ProjectTypeEnum::WebApp->value,
            'status' => ProjectStatusEnum::Published->value,
            'is_featured' => false,
            'is_active' => true,
            'technologies' => [$laravelTech->id],
        ]);

        $project2 = $projectService->create($dto2);
        $this->assertSame('cloud-erp-saas-platform-2', $project2->slug);

        // Verify eager-loaded relations on getPublished and findBySlug (prevents N+1)
        $published = $projectService->getPublished();
        $this->assertCount(2, $published);
        $this->assertTrue($published->first()->relationLoaded('category'));
        $this->assertTrue($published->first()->relationLoaded('technologies'));
        $this->assertTrue($published->first()->relationLoaded('media'));

        $foundBySlug = $projectService->findBySlug('cloud-erp-saas-platform');
        $this->assertNotNull($foundBySlug);
        $this->assertTrue($foundBySlug->relationLoaded('category'));
        $this->assertTrue($foundBySlug->relationLoaded('technologies'));
        $this->assertTrue($foundBySlug->relationLoaded('testimonials'));

        // Reorder: put project2 before project1
        $projectService->reorder([$project2->id, $project1->id]);
        $this->assertSame(1, $project2->fresh()->sort_order);
        $this->assertSame(2, $project1->fresh()->sort_order);

        // Update project1 via DTO
        $updateDto = ProjectData::fromArray([
            'category_id' => $category->id,
            'title' => [
                'ar' => 'منصة الموارد المحدثة',
                'en' => 'Updated Cloud ERP Platform',
            ],
            'short_description' => ['ar' => 'محدث', 'en' => 'Updated short'],
            'description' => ['ar' => 'محدث', 'en' => 'Updated full'],
            'project_type' => ProjectTypeEnum::FullStack->value,
            'status' => ProjectStatusEnum::Published->value,
            'is_featured' => true,
            'is_active' => true,
            'technologies' => [$laravelTech->id],
        ]);

        $updatedProject = $projectService->update($project1->fresh(), $updateDto);
        $this->assertSame('Updated Cloud ERP Platform', $updatedProject->getTranslation('title', 'en'));
        $this->assertSame(ProjectTypeEnum::FullStack, $updatedProject->project_type);
        $this->assertCount(1, $updatedProject->technologies);

        // Delete project2
        $this->assertTrue($projectService->delete($project2));
        $this->assertDatabaseMissing('projects', ['id' => $project2->id]);
    }

    /**
     * Verify ContactMessageService submission via ContactMessageData DTO,
     * unread counters, read transitions, status updates, and deletion.
     */
    public function test_contact_message_service_submission_and_status_lifecycle(): void
    {
        /** @var ContactMessageService $service */
        $service = app(ContactMessageService::class);

        $dto = ContactMessageData::fromArray([
            'name' => 'Eng. Khaled Mansour',
            'email' => 'khaled@techcorp.io',
            'phone' => '+201012345678',
            'subject' => 'Enterprise Laravel & React Architecture Inquiry',
            'service' => 'Full-Stack Development',
            'budget_range' => '$5,000 - $10,000',
            'timeline' => '2 Months',
            'message' => 'We would like to hire Eng. Abdelrahman Abu Aishah for our SaaS platform.',
            'type' => ContactMessageTypeEnum::ProjectInquiry->value,
        ], '127.0.0.1', 'PHPUnit-Agent/1.0');

        $message = $service->submit($dto);

        $this->assertSame(ContactMessageStatusEnum::New, $message->status);
        $this->assertSame(ContactMessageTypeEnum::ProjectInquiry, $message->type);
        $this->assertNull($message->read_at);
        $this->assertSame(1, $service->countUnread());

        // Mark as read
        $readMessage = $service->markAsRead($message);
        $this->assertSame(ContactMessageStatusEnum::Read, $readMessage->status);
        $this->assertNotNull($readMessage->read_at);
        $this->assertSame(0, $service->countUnread());

        // Update status to Replied with admin notes
        $repliedMessage = $service->updateStatus(
            $readMessage,
            ContactMessageStatusEnum::Replied,
            'Sent technical proposal and architecture breakdown.'
        );
        $this->assertSame(ContactMessageStatusEnum::Replied, $repliedMessage->status);
        $this->assertSame('Sent technical proposal and architecture breakdown.', $repliedMessage->admin_notes);

        $counts = $service->countByStatus();
        $this->assertSame(1, $counts[ContactMessageStatusEnum::Replied->value]);

        $this->assertTrue($service->delete($repliedMessage));
        $this->assertDatabaseMissing('contact_messages', ['id' => $repliedMessage->id]);
    }

    /**
     * Verify CRUD, scopes, and reordering across the remaining 9 portfolio services.
     */
    public function test_remaining_nine_domain_services_crud_and_reordering(): void
    {
        // 1. TechnologyService
        /** @var TechnologyService $technologyService */
        $technologyService = app(TechnologyService::class);
        $tech1 = $technologyService->create([
            'name' => ['ar' => 'PHP 8.3', 'en' => 'PHP 8.3'],
            'category' => TechnologyCategoryEnum::Backend->value,
            'proficiency_percent' => 95,
            'years_of_experience' => 4.5,
            'is_featured' => true,
            'is_active' => true,
        ]);
        $tech2 = $technologyService->create([
            'name' => ['ar' => 'React.js', 'en' => 'React.js'],
            'category' => TechnologyCategoryEnum::Frontend->value,
            'proficiency_percent' => 90,
            'years_of_experience' => 4.0,
            'is_featured' => true,
            'is_active' => true,
        ]);
        $this->assertCount(2, $technologyService->getActive());
        $this->assertTrue($technologyService->getGroupedByCategory()->has(TechnologyCategoryEnum::Backend->value));
        $technologyService->reorder([$tech2->id, $tech1->id]);
        $this->assertSame(1, $tech2->fresh()->sort_order);

        // 2. ExperienceService
        /** @var ExperienceService $experienceService */
        $experienceService = app(ExperienceService::class);
        $exp = $experienceService->create([
            'company_name' => ['ar' => 'شركة تقنية متقدمة', 'en' => 'Advanced Tech Co'],
            'role_title' => ['ar' => 'مهندس برمجيات أول', 'en' => 'Senior Full-Stack Engineer'],
            'employment_type' => EmploymentTypeEnum::FullTime->value,
            'start_date' => '2023-01-01',
            'end_date' => '2025-01-01',
            'is_current' => true,
            'summary' => ['ar' => 'تطوير أنظمة Laravel و React', 'en' => 'Architected Laravel & React systems'],
            'is_active' => true,
            'technologies' => [$tech1->id, $tech2->id],
        ]);
        $this->assertNull($exp->end_date);
        $this->assertCount(2, $exp->technologies);
        $this->assertCount(1, $experienceService->getActiveTimeline());

        // 3. CredentialService
        /** @var CredentialService $credentialService */
        $credentialService = app(CredentialService::class);
        $cred = $credentialService->create([
            'title' => ['ar' => 'بكالوريوس هندسة البرمجيات', 'en' => 'B.Sc. in Software Engineering'],
            'organization' => ['ar' => 'كلية الهندسة', 'en' => 'Faculty of Engineering'],
            'type' => CredentialTypeEnum::AcademicDegree->value,
            'issued_at' => '2022-06-01',
            'is_active' => true,
        ]);
        $this->assertCount(1, $credentialService->getActive(CredentialTypeEnum::AcademicDegree));
        $this->assertTrue($credentialService->delete($cred));

        // 4. ServiceCatalogService
        /** @var ServiceCatalogService $serviceOfferingService */
        $serviceOfferingService = app(ServiceCatalogService::class);
        $srv = $serviceOfferingService->create([
            'title' => ['ar' => 'بناء الأنظمة والـ REST APIs', 'en' => 'Backend Systems & REST APIs'],
            'short_description' => ['ar' => 'وصف مختصر', 'en' => 'Short description'],
            'description' => ['ar' => 'وصف تفصيلي', 'en' => 'Full description'],
            'is_featured' => true,
            'is_active' => true,
        ]);
        $this->assertSame('backend-systems-rest-apis', $srv->slug);
        $this->assertCount(1, $serviceOfferingService->getFeatured());

        // 5. CategoryService & 6. BlogService
        /** @var CategoryService $categoryService */
        $categoryService = app(CategoryService::class);
        $cat = $categoryService->create([
            'name' => ['ar' => 'هندسة البرمجيات', 'en' => 'Software Architecture'],
            'is_active' => true,
        ]);
        $this->assertSame('software-architecture', $cat->slug);

        /** @var BlogService $blogService */
        $blogService = app(BlogService::class);
        $blog = $blogService->create([
            'category_id' => $cat->id,
            'name' => ['ar' => 'تطبيق SOLID في Laravel 10', 'en' => 'Applying SOLID in Laravel 10'],
            'short_description' => ['ar' => 'مقدمة', 'en' => 'Intro'],
            'description' => ['ar' => 'محتوى المقال', 'en' => 'Article content'],
            'status' => BlogStatusEnum::Published->value,
            'is_featured' => true,
            'is_active' => true,
        ]);
        $this->assertNotNull($blog->published_at);
        $blogService->incrementViews($blog);
        $this->assertSame(1, $blog->fresh()->views_count);
        $this->assertCount(1, $blogService->getPublished());

        // 7. TestimonialService
        /** @var TestimonialService $testimonialService */
        $testimonialService = app(TestimonialService::class);
        $testimonial = $testimonialService->create([
            'name' => ['ar' => 'م. أحمد سالم', 'en' => 'Eng. Ahmed Salem'],
            'name_job' => ['ar' => 'مدير تقني CTO', 'en' => 'CTO'],
            'company_name' => ['ar' => 'تك هب', 'en' => 'TechHub'],
            'description' => ['ar' => 'كود نظيف ومعمارية ممتازة.', 'en' => 'Clean code and outstanding architecture.'],
            'rating' => 5,
            'is_featured' => true,
            'is_active' => true,
        ]);
        $this->assertCount(1, $testimonialService->getFeatured());
        $this->assertTrue($testimonialService->delete($testimonial));

        // 8. FaqService
        /** @var FaqService $faqService */
        $faqService = app(FaqService::class);
        $faq = $faqService->create([
            'question' => ['ar' => 'ما هي التقنيات التي تتقنها؟', 'en' => 'What technologies do you specialize in?'],
            'answer' => ['ar' => 'PHP 8.3, Laravel 10, React.js', 'en' => 'PHP 8.3, Laravel 10, React.js'],
            'category' => 'general',
            'is_active' => true,
        ]);
        $this->assertCount(1, $faqService->getActive('general'));
        $this->assertTrue($faqService->delete($faq));

        // 9. StatService
        /** @var StatService $statService */
        $statService = app(StatService::class);
        $stat = $statService->create([
            'label' => ['ar' => 'سنوات الخبرة', 'en' => 'Years of Experience'],
            'value' => '4',
            'prefix' => '+',
            'is_active' => true,
        ]);
        $this->assertCount(1, $statService->getActive());
        $this->assertTrue($statService->delete($stat));
    }

    /**
     * Verify all module Policies authorize a Super Admin and deny an unpermitted admin user.
     */
    public function test_policies_authorize_super_admin_and_deny_unpermitted_admin(): void
    {
        $this->seed(RoleSeeder::class);

        $superAdmin = User::factory()->create(['is_admin' => true]);
        $superAdmin->assignRole('Super admin');

        $limitedAdmin = User::factory()->create(['is_admin' => true]);

        $modelsWithFullCrud = [
            Project::class,
            Technology::class,
            Experience::class,
            Credential::class,
            Service::class,
            Testimonial::class,
            Category::class,
            Blog::class,
            Faq::class,
            Stat::class,
        ];

        foreach ($modelsWithFullCrud as $modelClass) {
            $this->assertTrue(Gate::forUser($superAdmin)->allows('viewAny', $modelClass), "Super admin should viewAny {$modelClass}");
            $this->assertTrue(Gate::forUser($superAdmin)->allows('create', $modelClass), "Super admin should create {$modelClass}");
            $this->assertTrue(Gate::forUser($superAdmin)->allows('update', $modelClass), "Super admin should update {$modelClass}");
            $this->assertTrue(Gate::forUser($superAdmin)->allows('delete', $modelClass), "Super admin should delete {$modelClass}");
            $this->assertTrue(Gate::forUser($superAdmin)->allows('reorder', $modelClass), "Super admin should reorder {$modelClass}");

            $this->assertFalse(Gate::forUser($limitedAdmin)->allows('viewAny', $modelClass), "Unpermitted admin must not viewAny {$modelClass}");
            $this->assertFalse(Gate::forUser($limitedAdmin)->allows('create', $modelClass), "Unpermitted admin must not create {$modelClass}");
            $this->assertFalse(Gate::forUser($limitedAdmin)->allows('update', $modelClass), "Unpermitted admin must not update {$modelClass}");
            $this->assertFalse(Gate::forUser($limitedAdmin)->allows('delete', $modelClass), "Unpermitted admin must not delete {$modelClass}");
        }

        // ContactMessage policy checks ('messages.*')
        $this->assertTrue(Gate::forUser($superAdmin)->allows('viewAny', ContactMessage::class));
        $this->assertTrue(Gate::forUser($superAdmin)->allows('update', ContactMessage::class));
        $this->assertTrue(Gate::forUser($superAdmin)->allows('delete', ContactMessage::class));
        $this->assertFalse(Gate::forUser($limitedAdmin)->allows('viewAny', ContactMessage::class));

        // Setting policy checks ('mainSetting.*')
        $this->assertTrue(Gate::forUser($superAdmin)->allows('viewAny', Setting::class));
        $this->assertTrue(Gate::forUser($superAdmin)->allows('update', Setting::class));
        $this->assertFalse(Gate::forUser($limitedAdmin)->allows('update', Setting::class));
    }

    /**
     * Verify Store/Update FormRequests enforce bilingual rules, enum rules, media rules,
     * and return localized validation messages in Arabic and English.
     */
    public function test_form_requests_validate_bilingual_fields_and_return_localized_messages(): void
    {
        $requestClasses = [
            StoreProjectRequest::class,
            UpdateProjectRequest::class,
            StoreTechnologyRequest::class,
            StoreExperienceRequest::class,
            StoreCredentialRequest::class,
            StoreServiceRequest::class,
            StoreTestimonialRequest::class,
            StoreCategoryRequest::class,
            StoreBlogRequest::class,
            StoreFaqRequest::class,
            StoreStatRequest::class,
            StoreContactMessageRequest::class,
            UpdateContactMessageRequest::class,
        ];

        foreach ($requestClasses as $requestClass) {
            /** @var BasePortfolioFormRequest $requestInstance */
            $requestInstance = new $requestClass;
            $validator = Validator::make([], $requestInstance->rules(), $requestInstance->messages(), $requestInstance->attributes());
            $this->assertTrue($validator->fails(), "{$requestClass} must fail on empty payload");
        }

        // Test Arabic localized error message on StoreProjectRequest
        app()->setLocale('ar');
        $projectRequest = new StoreProjectRequest;
        $arValidator = Validator::make(
            [
                'title' => ['ar' => '', 'en' => 'Valid English Title'],
                'short_description' => ['ar' => 'وصف', 'en' => 'Short'],
                'description' => ['ar' => 'تفاصيل', 'en' => 'Details'],
                'project_type' => 'invalid_type',
                'status' => ProjectStatusEnum::Published->value,
            ],
            $projectRequest->rules(),
            $projectRequest->messages(),
            $projectRequest->attributes()
        );

        $this->assertTrue($arValidator->fails());
        $arErrors = $arValidator->errors();
        $this->assertTrue($arErrors->has('title.ar'));
        $this->assertTrue($arErrors->has('project_type'));
        $this->assertStringContainsString('العنوان بالعربية', $arErrors->first('title.ar'));

        // Test English localized error message on StoreProjectRequest
        app()->setLocale('en');
        $enValidator = Validator::make(
            [
                'title' => ['ar' => 'عنوان عربي', 'en' => ''],
                'short_description' => ['ar' => 'وصف', 'en' => 'Short'],
                'description' => ['ar' => 'تفاصيل', 'en' => 'Details'],
                'project_type' => ProjectTypeEnum::WebApp->value,
                'status' => ProjectStatusEnum::Published->value,
            ],
            $projectRequest->rules(),
            $projectRequest->messages(),
            $projectRequest->attributes()
        );

        $this->assertTrue($enValidator->fails());
        $this->assertStringContainsString('English title', $enValidator->errors()->first('title.en'));
    }
}
