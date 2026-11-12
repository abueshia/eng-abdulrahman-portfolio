<?php

/**
 * SettingServiceTest
 *
 * Verifies the Phase 3 Dynamic Settings Engine:
 * - SettingKeyEnum single-source-of-truth metadata (group, type, isTranslatable, default)
 * - Forever caching (`portfolio.settings`) and automatic cache invalidation via SettingObserver
 * - Bilingual (`ar`/`en`) resolution and fallback defaults via SettingService and `setting()` helper
 * - Batch updating and MediaLibrary file uploads (`logo`, `cv_file_en`) via SettingUpdateData DTO
 * - Admin Settings tabbed UI access control (200 for authorized admin, 403 for unauthorized user)
 */

declare(strict_types=1);

namespace Tests\Feature;

use App\DTOs\SettingUpdateData;
use App\Enums\SettingGroupEnum;
use App\Enums\SettingKeyEnum;
use App\Enums\SettingTypeEnum;
use App\Models\Setting;
use App\Models\User;
use App\Services\SettingService;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SettingServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Ensure SettingKeyEnum defines group, type, translatability, and default values for all keys.
     */
    public function test_setting_key_enum_acts_as_single_source_of_truth(): void
    {
        $ownerKey = SettingKeyEnum::OwnerName;

        $this->assertSame(SettingGroupEnum::General, $ownerKey->group());
        $this->assertSame(SettingTypeEnum::Text, $ownerKey->type());
        $this->assertTrue($ownerKey->isTranslatable());
        $this->assertSame('Eng. Abdelrahman Abu Aishah', $ownerKey->defaultForLocale('en'));
        $this->assertSame('مهندس / عبدالرحمن أبو عيشة', $ownerKey->defaultForLocale('ar'));

        $visibilityKey = SettingKeyEnum::ShowProjectsSection;
        $this->assertSame(SettingGroupEnum::SectionsVisibility, $visibilityKey->group());
        $this->assertSame(SettingTypeEnum::Boolean, $visibilityKey->type());
        $this->assertFalse($visibilityKey->isTranslatable());
        $this->assertTrue($visibilityKey->defaultForLocale());
    }

    /**
     * Ensure SettingService caches settings under `portfolio.settings` and SettingObserver flushes cache on save/delete.
     */
    public function test_setting_service_caches_and_observer_invalidates_automatically(): void
    {
        $service = app(SettingService::class);
        Cache::forget(SettingService::CACHE_KEY);

        // 1. When DB is empty, fallback default from SettingKeyEnum is returned and cache is populated
        $this->assertSame(
            'Eng. Abdelrahman Abu Aishah',
            $service->get(SettingKeyEnum::OwnerName, 'en')
        );
        $this->assertTrue(Cache::has(SettingService::CACHE_KEY));

        // 2. Creating/Updating a Setting triggers SettingObserver::saved() which flushes the cache
        $setting = Setting::query()->create([
            'group' => SettingGroupEnum::General,
            'key' => SettingKeyEnum::OwnerName->value,
            'value' => [
                'ar' => 'م. عبدالرحمن أبو عيشة - محدث',
                'en' => 'Eng. Abdelrahman Abu Aishah - Updated',
            ],
            'type' => SettingTypeEnum::Text,
            'is_translatable' => true,
        ]);

        $this->assertFalse(Cache::has(SettingService::CACHE_KEY));

        // 3. Subsequent read re-populates cache with the new value
        $this->assertSame('Eng. Abdelrahman Abu Aishah - Updated', setting('owner_name', 'en'));
        $this->assertSame('م. عبدالرحمن أبو عيشة - محدث', setting('owner_name', 'ar'));
        $this->assertTrue(Cache::has(SettingService::CACHE_KEY));

        // 4. Deleting the setting flushes the cache again and reverts to SettingKeyEnum default
        $setting->delete();
        $this->assertFalse(Cache::has(SettingService::CACHE_KEY));
        $this->assertSame('Eng. Abdelrahman Abu Aishah', setting('owner_name', 'en'));
    }

    /**
     * Ensure SettingService::updateSettings persists translatable values, booleans, and MediaLibrary files.
     */
    public function test_setting_service_updates_values_and_uploads_media_files(): void
    {
        Storage::fake('public');

        $service = app(SettingService::class);
        $logoFile = UploadedFile::fake()->image('portfolio-logo.png', 200, 60);
        $cvFile = UploadedFile::fake()->create('Eng-Abdelrahman-CV.pdf', 250, 'application/pdf');

        $dto = new SettingUpdateData(
            settings: [
                SettingKeyEnum::HeroHeadline->value => [
                    'ar' => 'عنوان هيرو جديد بالعربية',
                    'en' => 'New Hero Headline in English',
                ],
                SettingKeyEnum::AvailableForHire->value => '0',
                SettingKeyEnum::ContactEmail->value => 'hire@abdelrahman-dev.com',
            ],
            files: [
                SettingKeyEnum::Logo->value => $logoFile,
                SettingKeyEnum::CvFileEn->value => $cvFile,
            ],
            activeGroup: SettingGroupEnum::Hero->value,
        );

        $service->updateSettings($dto);

        $this->assertSame('عنوان هيرو جديد بالعربية', setting(SettingKeyEnum::HeroHeadline, 'ar'));
        $this->assertSame('New Hero Headline in English', setting(SettingKeyEnum::HeroHeadline, 'en'));
        $this->assertFalse((bool) setting(SettingKeyEnum::AvailableForHire));
        $this->assertSame('hire@abdelrahman-dev.com', setting(SettingKeyEnum::ContactEmail));

        $logoSetting = Setting::query()->where('key', SettingKeyEnum::Logo->value)->first();
        $this->assertNotNull($logoSetting);
        $this->assertCount(1, $logoSetting->getMedia('settings'));
        $this->assertNotEmpty(setting(SettingKeyEnum::Logo));
    }

    /**
     * Ensure authorized admins can view and update the tabbed settings page while unauthorized admins get 403.
     */
    public function test_admin_settings_page_authorization_and_update_endpoint(): void
    {
        $this->refreshApplicationWithLocale('ar');
        $arAdmin = User::factory()->create(['is_admin' => true]);
        $this->seed(RoleSeeder::class);

        // Authorized Super Admin can view the tabbed settings page in Arabic
        $arResponse = $this->actingAs($arAdmin, 'admin')->get('/ar/admin/all-settings');
        $arResponse->assertStatus(200);
        $arResponse->assertSee('الواجهة الترحيبية والسيرة الذاتية');

        // Refresh application with English locale and verify English view, update, and 403 check
        $this->refreshApplicationWithLocale('en');
        $enAdmin = User::factory()->create(['is_admin' => true]);
        $this->seed(RoleSeeder::class);

        $enResponse = $this->actingAs($enAdmin, 'admin')->get('/en/admin/all-settings');
        $enResponse->assertStatus(200);
        $enResponse->assertSee('Hero & CV');
        $enResponse->assertSee('Sections Visibility');

        // Authorized Super Admin can submit the settings update form
        $updateResponse = $this->actingAs($enAdmin, 'admin')->put('/en/admin/all-settings', [
            'active_group' => SettingGroupEnum::Cta->value,
            'settings' => [
                SettingKeyEnum::CtaTitle->value => [
                    'ar' => 'تواصل لبناء مشروعك',
                    'en' => 'Let Us Build Your Next System',
                ],
                SettingKeyEnum::ContactEmail->value => 'contact@abdelrahman-dev.com',
            ],
        ]);

        $updateResponse->assertRedirect(route('admin.all_settings.index', ['group' => 'cta']));
        $this->assertSame('Let Us Build Your Next System', setting(SettingKeyEnum::CtaTitle, 'en'));

        // Unauthorized admin without permissions gets 403 Forbidden
        $unauthorizedUser = User::factory()->create(['is_admin' => true]);
        $this->actingAs($unauthorizedUser, 'admin')
            ->get('/en/admin/all-settings')
            ->assertStatus(403);
    }
}
