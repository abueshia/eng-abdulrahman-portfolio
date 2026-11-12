<?php

/**
 * PortfolioDomainSchemaTest
 *
 * Verifies Phase 2 domain architecture: PHP 8.3 Backed Enums (labels, colors, options),
 * Eloquent Models, Relationships, Local Scopes, Spatie Translations, Model Factories,
 * and full Database Seeding for Eng. Abdelrahman Abu Aishah's Portfolio.
 */

declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\BlogStatusEnum;
use App\Enums\ContactMessageStatusEnum;
use App\Enums\ContactMessageTypeEnum;
use App\Enums\CredentialTypeEnum;
use App\Enums\EmploymentTypeEnum;
use App\Enums\ProjectStatusEnum;
use App\Enums\ProjectTypeEnum;
use App\Enums\SettingGroupEnum;
use App\Enums\SettingTypeEnum;
use App\Enums\TechnologyCategoryEnum;
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
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class PortfolioDomainSchemaTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Ensure all PHP 8.3 Backed Enums return translated labels in English and Arabic along with badge colors.
     */
    public function test_backed_enums_provide_localized_labels_and_badge_colors(): void
    {
        app()->setLocale('en');
        $this->assertSame('Published', ProjectStatusEnum::Published->label());
        $this->assertSame('Published', BlogStatusEnum::Published->label());
        $this->assertSame('success', ProjectStatusEnum::Published->color());
        $this->assertSame('Full-Stack Solution', ProjectTypeEnum::FullStack->label());
        $this->assertSame('Backend Engineering', TechnologyCategoryEnum::Backend->label());
        $this->assertSame('Full-Time', EmploymentTypeEnum::FullTime->label());
        $this->assertSame('Academic Degree', CredentialTypeEnum::AcademicDegree->label());
        $this->assertSame('Project Inquiry', ContactMessageTypeEnum::ProjectInquiry->label());
        $this->assertSame('New', ContactMessageStatusEnum::New->label());
        $this->assertSame('About', SettingGroupEnum::About->label());
        $this->assertSame('Sections Visibility', SettingGroupEnum::SectionsVisibility->label());
        $this->assertSame('CTA', SettingGroupEnum::Cta->label());
        $this->assertSame('Text Input', SettingTypeEnum::Text->label());

        app()->setLocale('ar');
        $this->assertSame('منشور', ProjectStatusEnum::Published->label());
        $this->assertSame('نظام برمجي متكامل (Full-Stack)', ProjectTypeEnum::FullStack->label());
        $this->assertSame('تطوير الواجهات الخلفية (Backend)', TechnologyCategoryEnum::Backend->label());
        $this->assertNotEmpty(ProjectStatusEnum::options());
    }

    /**
     * Ensure Project model relationships, Enum casts, translations, and local scopes work properly.
     */
    public function test_project_relationships_casts_translations_and_scopes(): void
    {
        $category = Category::factory()->create();
        $laravel = Technology::factory()->create([
            'category' => TechnologyCategoryEnum::Backend,
            'is_featured' => true,
        ]);
        $react = Technology::factory()->create([
            'category' => TechnologyCategoryEnum::Frontend,
            'is_featured' => true,
        ]);

        $publishedProject = Project::factory()->create([
            'category_id' => $category->id,
            'title' => [
                'en' => 'Enterprise ERP Platform',
                'ar' => 'منصة إدارة الموارد المؤسسية',
            ],
            'project_type' => ProjectTypeEnum::FullStack,
            'status' => ProjectStatusEnum::Published,
            'is_featured' => true,
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $draftProject = Project::factory()->create([
            'category_id' => $category->id,
            'project_type' => ProjectTypeEnum::ApiBackend,
            'status' => ProjectStatusEnum::Draft,
            'is_featured' => false,
            'is_active' => true,
            'sort_order' => 2,
        ]);

        $publishedProject->technologies()->attach([
            $laravel->id => ['role_in_project' => 'Backend API', 'sort_order' => 1],
            $react->id => ['role_in_project' => 'Frontend SPA', 'sort_order' => 2],
        ]);

        Testimonial::factory()->create([
            'project_id' => $publishedProject->id,
            'rating' => 5,
        ]);

        $this->assertInstanceOf(ProjectStatusEnum::class, $publishedProject->status);
        $this->assertInstanceOf(ProjectTypeEnum::class, $publishedProject->project_type);
        $this->assertSame('Enterprise ERP Platform', $publishedProject->getTranslation('title', 'en'));
        $this->assertSame('منصة إدارة الموارد المؤسسية', $publishedProject->getTranslation('title', 'ar'));
        $this->assertCount(2, $publishedProject->technologies);
        $this->assertCount(1, $publishedProject->testimonials);
        $this->assertTrue($publishedProject->category->is($category));

        $this->assertCount(1, Project::query()->published()->get());
        $this->assertCount(1, Project::query()->featured()->get());
        $this->assertCount(1, Project::query()->ofType(ProjectTypeEnum::FullStack)->get());
        $this->assertFalse(Project::query()->published()->get()->contains($draftProject));
    }

    /**
     * Ensure Experience, Credential, Service, Faq, Stat, and ContactMessage models and scopes operate cleanly.
     */
    public function test_experience_credential_service_and_contact_message_models(): void
    {
        $tech = Technology::factory()->create();
        $experience = Experience::factory()->create([
            'employment_type' => EmploymentTypeEnum::FullTime,
            'is_current' => true,
        ]);
        $experience->technologies()->attach($tech->id);

        $credential = Credential::factory()->create([
            'type' => CredentialTypeEnum::AcademicDegree,
        ]);

        $service = Service::factory()->create(['is_featured' => true]);
        $faq = Faq::factory()->create(['is_active' => true]);
        $stat = Stat::factory()->create(['value' => '4', 'prefix' => '+']);
        $message = ContactMessage::factory()->create([
            'type' => ContactMessageTypeEnum::ProjectInquiry,
            'status' => ContactMessageStatusEnum::New,
        ]);

        $this->assertCount(1, $experience->technologies);
        $this->assertSame(EmploymentTypeEnum::FullTime, $experience->employment_type);
        $this->assertSame(CredentialTypeEnum::AcademicDegree, $credential->type);
        $this->assertCount(1, Service::query()->active()->featured()->get());
        $this->assertCount(1, Faq::query()->active()->ordered()->get());
        $this->assertCount(1, Stat::query()->active()->ordered()->get());
        $this->assertCount(1, ContactMessage::query()->unread()->ofType(ContactMessageTypeEnum::ProjectInquiry)->get());
        $this->assertSame($message->id, ContactMessage::query()->withStatus(ContactMessageStatusEnum::New)->first()?->id);
    }

    /**
     * Ensure dynamic Settings and the global setting() helper resolve bilingual values accurately.
     */
    public function test_dynamic_settings_and_helper_resolve_bilingual_values(): void
    {
        Setting::factory()->create([
            'group' => SettingGroupEnum::About,
            'key' => 'owner_name',
            'value' => [
                'ar' => 'مهندس / عبدالرحمن أبو عيشة',
                'en' => 'Eng. Abdelrahman Abu Aishah',
            ],
            'type' => SettingTypeEnum::Text,
            'is_translatable' => true,
        ]);

        Cache::forget('settings');

        $this->assertSame('مهندس / عبدالرحمن أبو عيشة', setting('owner_name', 'ar'));
        $this->assertSame('Eng. Abdelrahman Abu Aishah', setting('owner_name', 'en'));
        $this->assertCount(1, Setting::query()->byGroup(SettingGroupEnum::About)->get());
    }

    /**
     * Ensure the full DatabaseSeeder runs cleanly and populates Eng. Abdelrahman Abu Aishah's portfolio data.
     */
    public function test_database_seeder_populates_complete_portfolio_data(): void
    {
        $this->seed(DatabaseSeeder::class);

        $this->assertDatabaseHas('users', ['is_admin' => true]);
        $this->assertDatabaseHas('roles', ['name' => 'Super admin', 'guard_name' => 'admin']);
        $this->assertGreaterThanOrEqual(20, Setting::query()->count());
        $this->assertGreaterThanOrEqual(10, Technology::query()->count());
        $this->assertGreaterThanOrEqual(3, Project::query()->published()->count());
        $this->assertGreaterThanOrEqual(4, Service::query()->active()->count());
        $this->assertGreaterThanOrEqual(2, Experience::query()->active()->count());
        $this->assertGreaterThanOrEqual(3, Credential::query()->active()->count());
        $this->assertGreaterThanOrEqual(4, Stat::query()->active()->count());
    }
}
