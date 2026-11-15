<?php

/**
 * AdminPhase5AControllersTest
 *
 * Feature tests verifying Phase 5A:
 * - Rename of ServiceService to ServiceCatalogService
 * - Thin Admin Controllers, ViewModels, and Metronic 8 Views for:
 *   Projects, Technologies, and Experiences (CRUD, DataTables JSON, Reorder, Authorization).
 */

declare(strict_types=1);

namespace Tests\Feature\Admin;

use App\Enums\EmploymentTypeEnum;
use App\Enums\ProjectStatusEnum;
use App\Enums\ProjectTypeEnum;
use App\Enums\TechnologyCategoryEnum;
use App\Models\Category;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Technology;
use App\Models\User;
use App\Services\ServiceCatalogService;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPhase5AControllersTest extends TestCase
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
     * Verify ServiceService was renamed to ServiceCatalogService.
     */
    public function test_service_catalog_service_exists_and_legacy_service_service_removed(): void
    {
        $this->assertTrue(class_exists(ServiceCatalogService::class));
        $this->assertFalse(class_exists('App\\Services\\ServiceService'));
        $this->assertInstanceOf(ServiceCatalogService::class, app(ServiceCatalogService::class));
    }

    /**
     * Verify full lifecycle of Admin ProjectController (index, table, create, store, show, edit, update, reorder, destroy).
     */
    public function test_admin_project_controller_crud_datatables_and_reorder(): void
    {
        $category = Category::factory()->create(['is_active' => true]);
        $tech = Technology::factory()->create(['is_active' => true]);

        $this->actingAs($this->superAdmin, 'admin')
            ->get('/en/admin/project')
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->get('/en/admin/project/create')
            ->assertOk();

        $storeResponse = $this->actingAs($this->superAdmin, 'admin')
            ->post('/en/admin/project', [
                'category_id' => $category->id,
                'title' => [
                    'ar' => 'منصة التجارة الإلكترونية المؤسسية',
                    'en' => 'Enterprise E-Commerce Platform',
                ],
                'subtitle' => [
                    'ar' => 'بنية Laravel 10 و React.js',
                    'en' => 'Laravel 10 & React.js Architecture',
                ],
                'short_description' => [
                    'ar' => 'وصف مختصر للمشروع',
                    'en' => 'Short project summary',
                ],
                'description' => [
                    'ar' => 'وصف تفصيلي للمشروع ودراسة الحالة',
                    'en' => 'Detailed case study description',
                ],
                'project_type' => ProjectTypeEnum::Ecommerce->value,
                'status' => ProjectStatusEnum::Published->value,
                'live_url' => 'https://shop.example.com',
                'repo_url' => 'https://github.com/abdelrahman/shop',
                'is_featured' => '1',
                'is_active' => '1',
                'technologies' => [$tech->id],
            ]);

        $storeResponse->assertRedirect(route('admin.project.index'));

        $project = Project::query()->firstOrFail();
        $this->assertSame('enterprise-e-commerce-platform', $project->slug);
        $this->assertCount(1, $project->technologies);

        // DataTables AJAX JSON
        $this->actingAs($this->superAdmin, 'admin')
            ->getJson('/en/admin/project/table/show')
            ->assertOk()
            ->assertJsonStructure(['data', 'recordsTotal', 'recordsFiltered']);

        // Show & Edit views
        $this->actingAs($this->superAdmin, 'admin')
            ->get("/en/admin/project/{$project->id}")
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->get("/en/admin/project/{$project->id}/edit")
            ->assertOk();

        // Update
        $this->actingAs($this->superAdmin, 'admin')
            ->put("/en/admin/project/{$project->id}", [
                'category_id' => $category->id,
                'title' => [
                    'ar' => 'منصة التجارة الإلكترونية المحدثة',
                    'en' => 'Updated E-Commerce Platform',
                ],
                'short_description' => [
                    'ar' => 'وصف مختصر محدث',
                    'en' => 'Updated short summary',
                ],
                'description' => [
                    'ar' => 'وصف تفصيلي محدث',
                    'en' => 'Updated detailed description',
                ],
                'project_type' => ProjectTypeEnum::FullStack->value,
                'status' => ProjectStatusEnum::Published->value,
                'is_featured' => '1',
                'is_active' => '1',
                'technologies' => [$tech->id],
            ])
            ->assertRedirect(route('admin.project.index'));

        $this->assertSame('Updated E-Commerce Platform', $project->fresh()->getTranslation('title', 'en'));

        // Reorder view & save
        $project2 = Project::factory()->create(['sort_order' => 2]);
        $this->actingAs($this->superAdmin, 'admin')
            ->get('/en/admin/project/reorder/project')
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->postJson('/en/admin/project/reorder/save', [
                'items' => [$project2->id, $project->id],
            ])
            ->assertOk()
            ->assertJsonPath('status', 'success');

        $this->assertSame(1, $project2->fresh()->sort_order);
        $this->assertSame(2, $project->fresh()->sort_order);

        // Destroy
        $this->actingAs($this->superAdmin, 'admin')
            ->deleteJson("/en/admin/project/{$project2->id}")
            ->assertOk()
            ->assertJsonPath('status', 'success');

        $this->assertDatabaseMissing('projects', ['id' => $project2->id]);
    }

    /**
     * Verify full lifecycle of Admin TechnologyController.
     */
    public function test_admin_technology_controller_crud_datatables_and_reorder(): void
    {
        $this->actingAs($this->superAdmin, 'admin')
            ->get('/en/admin/technology')
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->get('/en/admin/technology/create')
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->post('/en/admin/technology', [
                'name' => ['ar' => 'Laravel 10', 'en' => 'Laravel 10'],
                'category' => TechnologyCategoryEnum::Backend->value,
                'proficiency_percent' => 95,
                'years_of_experience' => 4.5,
                'icon' => 'fa-brands fa-laravel',
                'badge_color' => '#FF2D20',
                'is_featured' => '1',
                'is_active' => '1',
            ])
            ->assertRedirect(route('admin.technology.index'));

        $technology = Technology::query()->firstOrFail();
        $this->assertSame('laravel-10', $technology->slug);

        $this->actingAs($this->superAdmin, 'admin')
            ->getJson('/en/admin/technology/table/show')
            ->assertOk()
            ->assertJsonStructure(['data']);

        $this->actingAs($this->superAdmin, 'admin')
            ->get("/en/admin/technology/{$technology->id}")
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->get("/en/admin/technology/{$technology->id}/edit")
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->put("/en/admin/technology/{$technology->id}", [
                'name' => ['ar' => 'PHP 8.3 & Laravel 10', 'en' => 'PHP 8.3 & Laravel 10'],
                'category' => TechnologyCategoryEnum::Backend->value,
                'proficiency_percent' => 98,
                'years_of_experience' => 4.5,
                'is_featured' => '1',
                'is_active' => '1',
            ])
            ->assertRedirect(route('admin.technology.index'));

        $this->assertSame(98, $technology->fresh()->proficiency_percent);

        $this->actingAs($this->superAdmin, 'admin')
            ->get('/en/admin/technology/reorder/technology')
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->postJson('/en/admin/technology/reorder/save', [
                'items' => [$technology->id],
            ])
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->deleteJson("/en/admin/technology/{$technology->id}")
            ->assertOk();

        $this->assertDatabaseMissing('technologies', ['id' => $technology->id]);
    }

    /**
     * Verify full lifecycle of Admin ExperienceController and authorization protection.
     */
    public function test_admin_experience_controller_crud_and_authorization(): void
    {
        $tech = Technology::factory()->create(['is_active' => true]);

        $this->actingAs($this->superAdmin, 'admin')
            ->get('/en/admin/experience')
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->get('/en/admin/experience/create')
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->post('/en/admin/experience', [
                'company_name' => ['ar' => 'شركة برمجيات', 'en' => 'Software Solutions Ltd'],
                'role_title' => ['ar' => 'مهندس برمجيات متكامل', 'en' => 'Full-Stack Software Engineer'],
                'employment_type' => EmploymentTypeEnum::FullTime->value,
                'location' => ['ar' => 'القاهرة، مصر', 'en' => 'Cairo, Egypt'],
                'company_url' => 'https://software.example.com',
                'start_date' => '2022-03-01',
                'is_current' => '1',
                'summary' => ['ar' => 'بناء أنظمة ويب متكاملة', 'en' => 'Architected full-stack web applications'],
                'achievements' => ['ar' => 'تحسين الأداء بنسبة 50%', 'en' => 'Improved performance by 50%'],
                'is_active' => '1',
                'technologies' => [$tech->id],
            ])
            ->assertRedirect(route('admin.experience.index'));

        $experience = Experience::query()->firstOrFail();
        $this->assertTrue($experience->is_current);
        $this->assertCount(1, $experience->technologies);

        $this->actingAs($this->superAdmin, 'admin')
            ->getJson('/en/admin/experience/table/show')
            ->assertOk()
            ->assertJsonStructure(['data']);

        $this->actingAs($this->superAdmin, 'admin')
            ->get("/en/admin/experience/{$experience->id}")
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->get("/en/admin/experience/{$experience->id}/edit")
            ->assertOk();

        $this->actingAs($this->superAdmin, 'admin')
            ->put("/en/admin/experience/{$experience->id}", [
                'company_name' => ['ar' => 'شركة برمجيات عالمية', 'en' => 'Global Software Solutions'],
                'role_title' => ['ar' => 'مهندس برمجيات أول', 'en' => 'Senior Full-Stack Engineer'],
                'employment_type' => EmploymentTypeEnum::Remote->value,
                'start_date' => '2022-03-01',
                'is_current' => '1',
                'summary' => ['ar' => 'ملخص محدث', 'en' => 'Updated summary'],
                'is_active' => '1',
                'technologies' => [$tech->id],
            ])
            ->assertRedirect(route('admin.experience.index'));

        $this->assertSame('Global Software Solutions', $experience->fresh()->getTranslation('company_name', 'en'));

        // Unpermitted admin must receive 403
        $unpermittedAdmin = User::factory()->create(['is_admin' => true]);
        $this->actingAs($unpermittedAdmin, 'admin')
            ->get('/en/admin/project')
            ->assertForbidden();
        $this->actingAs($unpermittedAdmin, 'admin')
            ->get('/en/admin/technology')
            ->assertForbidden();
        $this->actingAs($unpermittedAdmin, 'admin')
            ->get('/en/admin/experience')
            ->assertForbidden();

        // Delete experience
        $this->actingAs($this->superAdmin, 'admin')
            ->deleteJson("/en/admin/experience/{$experience->id}")
            ->assertOk();

        $this->assertDatabaseMissing('experiences', ['id' => $experience->id]);
    }
}

