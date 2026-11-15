<?php

/**
 * Admin Dashboard Routes
 *
 * Defines localized and authenticated routes for the Portfolio Admin CMS.
 */

declare(strict_types=1);

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CredentialController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\StatController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\Admin\TestimonialController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ],
    static function (): void {
        Route::group([
            'middleware' => ['AdminCheck'],
            'prefix' => 'admin',
        ], static function (): void {
            // Dashboard Home
            Route::get('/', [DashboardController::class, 'index'])->name('index');

            // Roles & Permissions
            Route::group(['prefix' => 'role'], static function (): void {
                Route::get('/', [RoleController::class, 'index'])->name('role.index');
                Route::get('/create', [RoleController::class, 'create'])->name('role.create');
                Route::post('/', [RoleController::class, 'store'])->name('role.store');
                Route::get('/table/show', [RoleController::class, 'table'])->name('role.table');
                Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('role.edit');
                Route::put('/{role}', [RoleController::class, 'update'])->name('role.update');
                Route::delete('/{role}', [RoleController::class, 'destroy'])->name('role.destroy');
                Route::get('/{role}', [RoleController::class, 'show'])->name('role.show');
            });

            Route::get('/addPermissionsToRole/{role}', [RoleController::class, 'assignPermissionsPage'])
                ->name('role.addPermissionsToRole');
            Route::post('/role/{role}/permissions', [RoleController::class, 'givePermissions'])
                ->name('role.permissions');

            // Administrators
            Route::group(['prefix' => 'admin'], static function (): void {
                Route::get('/', [AdminController::class, 'index'])->name('admin.index');
                Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
                Route::post('/', [AdminController::class, 'store'])->name('admin.store');
                Route::get('/table/show', [AdminController::class, 'table'])->name('admin.table');
                Route::get('/{admin}', [AdminController::class, 'show'])->name('admin.show');
                Route::get('/{admin}/edit', [AdminController::class, 'edit'])->name('admin.edit');
                Route::put('/{admin}', [AdminController::class, 'update'])->name('admin.update');
                Route::delete('/{admin}', [AdminController::class, 'destroy'])->name('admin.destroy');
            });

            // Portfolio Projects & Case Studies
            Route::group(['prefix' => 'project'], static function (): void {
                Route::get('/', [ProjectController::class, 'index'])->name('project.index');
                Route::get('/create', [ProjectController::class, 'create'])->name('project.create');
                Route::post('/', [ProjectController::class, 'store'])->name('project.store');
                Route::get('/reorder/project', [ProjectController::class, 'reorder'])->name('project.reorder');
                Route::post('/reorder/save', [ProjectController::class, 'saveReorder'])->name('project.reorder.save');
                Route::get('/table/show', [ProjectController::class, 'table'])->name('project.table');
                Route::get('/{project}', [ProjectController::class, 'show'])->name('project.show');
                Route::get('/{project}/edit', [ProjectController::class, 'edit'])->name('project.edit');
                Route::put('/{project}', [ProjectController::class, 'update'])->name('project.update');
                Route::delete('/{project}', [ProjectController::class, 'destroy'])->name('project.destroy');
            });

            // Technologies & Technical Stack
            Route::group(['prefix' => 'technology'], static function (): void {
                Route::get('/', [TechnologyController::class, 'index'])->name('technology.index');
                Route::get('/create', [TechnologyController::class, 'create'])->name('technology.create');
                Route::post('/', [TechnologyController::class, 'store'])->name('technology.store');
                Route::get('/reorder/technology', [TechnologyController::class, 'reorder'])->name('technology.reorder');
                Route::post('/reorder/save', [TechnologyController::class, 'saveReorder'])->name('technology.reorder.save');
                Route::get('/table/show', [TechnologyController::class, 'table'])->name('technology.table');
                Route::get('/{technology}', [TechnologyController::class, 'show'])->name('technology.show');
                Route::get('/{technology}/edit', [TechnologyController::class, 'edit'])->name('technology.edit');
                Route::put('/{technology}', [TechnologyController::class, 'update'])->name('technology.update');
                Route::delete('/{technology}', [TechnologyController::class, 'destroy'])->name('technology.destroy');
            });

            // Professional Work Experiences
            Route::group(['prefix' => 'experience'], static function (): void {
                Route::get('/', [ExperienceController::class, 'index'])->name('experience.index');
                Route::get('/create', [ExperienceController::class, 'create'])->name('experience.create');
                Route::post('/', [ExperienceController::class, 'store'])->name('experience.store');
                Route::get('/reorder/experience', [ExperienceController::class, 'reorder'])->name('experience.reorder');
                Route::post('/reorder/save', [ExperienceController::class, 'saveReorder'])->name('experience.reorder.save');
                Route::get('/table/show', [ExperienceController::class, 'table'])->name('experience.table');
                Route::get('/{experience}', [ExperienceController::class, 'show'])->name('experience.show');
                Route::get('/{experience}/edit', [ExperienceController::class, 'edit'])->name('experience.edit');
                Route::put('/{experience}', [ExperienceController::class, 'update'])->name('experience.update');
                Route::delete('/{experience}', [ExperienceController::class, 'destroy'])->name('experience.destroy');
            });

            // Academic Degrees & Professional Credentials
            Route::group(['prefix' => 'credential'], static function (): void {
                Route::get('/', [CredentialController::class, 'index'])->name('credential.index');
                Route::get('/create', [CredentialController::class, 'create'])->name('credential.create');
                Route::post('/', [CredentialController::class, 'store'])->name('credential.store');
                Route::get('/reorder/credential', [CredentialController::class, 'reorder'])->name('credential.reorder');
                Route::post('/reorder/save', [CredentialController::class, 'saveReorder'])->name('credential.reorder.save');
                Route::get('/table/show', [CredentialController::class, 'table'])->name('credential.table');
                Route::get('/{credential}', [CredentialController::class, 'show'])->name('credential.show');
                Route::get('/{credential}/edit', [CredentialController::class, 'edit'])->name('credential.edit');
                Route::put('/{credential}', [CredentialController::class, 'update'])->name('credential.update');
                Route::delete('/{credential}', [CredentialController::class, 'destroy'])->name('credential.destroy');
            });

            // Engineering Services Catalog
            Route::group(['prefix' => 'service'], static function (): void {
                Route::get('/', [ServiceController::class, 'index'])->name('service.index');
                Route::get('/create', [ServiceController::class, 'create'])->name('service.create');
                Route::post('/', [ServiceController::class, 'store'])->name('service.store');
                Route::get('/reorder/service', [ServiceController::class, 'reorder'])->name('service.reorder');
                Route::post('/reorder/save', [ServiceController::class, 'saveReorder'])->name('service.reorder.save');
                Route::get('/table/show', [ServiceController::class, 'table'])->name('service.table');
                Route::get('/{service}', [ServiceController::class, 'show'])->name('service.show');
                Route::get('/{service}/edit', [ServiceController::class, 'edit'])->name('service.edit');
                Route::put('/{service}', [ServiceController::class, 'update'])->name('service.update');
                Route::delete('/{service}', [ServiceController::class, 'destroy'])->name('service.destroy');
            });

            // Categories
            Route::group(['prefix' => 'category'], static function (): void {
                Route::get('/', [CategoryController::class, 'index'])->name('category.index');
                Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
                Route::post('/', [CategoryController::class, 'store'])->name('category.store');
                Route::get('/reorder/category', [CategoryController::class, 'reorder'])->name('category.reorder');
                Route::post('/reorder/save', [CategoryController::class, 'saveReorder'])->name('category.reorder.save');
                Route::get('/table/show', [CategoryController::class, 'table'])->name('category.table');
                Route::get('/{category}', [CategoryController::class, 'show'])->name('category.show');
                Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
                Route::put('/{category}', [CategoryController::class, 'update'])->name('category.update');
                Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
            });

            // Technical Articles (Blogs)
            Route::group(['prefix' => 'blog'], static function (): void {
                Route::get('/', [BlogController::class, 'index'])->name('blog.index');
                Route::get('/create', [BlogController::class, 'create'])->name('blog.create');
                Route::post('/', [BlogController::class, 'store'])->name('blog.store');
                Route::get('/reorder/blog', [BlogController::class, 'reorder'])->name('blog.reorder');
                Route::post('/reorder/save', [BlogController::class, 'saveReorder'])->name('blog.reorder.save');
                Route::get('/table/show', [BlogController::class, 'table'])->name('blog.table');
                Route::get('/{blog}', [BlogController::class, 'show'])->name('blog.show');
                Route::get('/{blog}/edit', [BlogController::class, 'edit'])->name('blog.edit');
                Route::put('/{blog}', [BlogController::class, 'update'])->name('blog.update');
                Route::delete('/{blog}', [BlogController::class, 'destroy'])->name('blog.destroy');
            });

            // Client Testimonials
            Route::group(['prefix' => 'testimonial'], static function (): void {
                Route::get('/', [TestimonialController::class, 'index'])->name('testimonial.index');
                Route::get('/create', [TestimonialController::class, 'create'])->name('testimonial.create');
                Route::post('/', [TestimonialController::class, 'store'])->name('testimonial.store');
                Route::get('/reorder/testimonial', [TestimonialController::class, 'reorder'])->name('testimonial.reorder');
                Route::post('/reorder/save', [TestimonialController::class, 'saveReorder'])->name('testimonial.reorder.save');
                Route::get('/table/show', [TestimonialController::class, 'table'])->name('testimonial.table');
                Route::get('/{testimonial}', [TestimonialController::class, 'show'])->name('testimonial.show');
                Route::get('/{testimonial}/edit', [TestimonialController::class, 'edit'])->name('testimonial.edit');
                Route::put('/{testimonial}', [TestimonialController::class, 'update'])->name('testimonial.update');
                Route::delete('/{testimonial}', [TestimonialController::class, 'destroy'])->name('testimonial.destroy');
            });

            // Frequently Asked Questions (FAQs)
            Route::group(['prefix' => 'faq'], static function (): void {
                Route::get('/', [FaqController::class, 'index'])->name('faq.index');
                Route::get('/create', [FaqController::class, 'create'])->name('faq.create');
                Route::post('/', [FaqController::class, 'store'])->name('faq.store');
                Route::get('/reorder/faq', [FaqController::class, 'reorder'])->name('faq.reorder');
                Route::post('/reorder/save', [FaqController::class, 'saveReorder'])->name('faq.reorder.save');
                Route::get('/table/show', [FaqController::class, 'table'])->name('faq.table');
                Route::get('/{faq}', [FaqController::class, 'show'])->name('faq.show');
                Route::get('/{faq}/edit', [FaqController::class, 'edit'])->name('faq.edit');
                Route::put('/{faq}', [FaqController::class, 'update'])->name('faq.update');
                Route::delete('/{faq}', [FaqController::class, 'destroy'])->name('faq.destroy');
            });

            // Portfolio Numerical Statistics
            Route::group(['prefix' => 'stat'], static function (): void {
                Route::get('/', [StatController::class, 'index'])->name('stat.index');
                Route::get('/create', [StatController::class, 'create'])->name('stat.create');
                Route::post('/', [StatController::class, 'store'])->name('stat.store');
                Route::get('/reorder/stat', [StatController::class, 'reorder'])->name('stat.reorder');
                Route::post('/reorder/save', [StatController::class, 'saveReorder'])->name('stat.reorder.save');
                Route::get('/table/show', [StatController::class, 'table'])->name('stat.table');
                Route::get('/{stat}', [StatController::class, 'show'])->name('stat.show');
                Route::get('/{stat}/edit', [StatController::class, 'edit'])->name('stat.edit');
                Route::put('/{stat}', [StatController::class, 'update'])->name('stat.update');
                Route::delete('/{stat}', [StatController::class, 'destroy'])->name('stat.destroy');
            });

            // Contact Messages & Project Inquiries
            Route::group(['prefix' => 'message'], static function (): void {
                Route::get('/', [MessageController::class, 'index'])->name('message.index');
                Route::get('/table/show', [MessageController::class, 'table'])->name('message.table');
                Route::get('/{message}', [MessageController::class, 'show'])->name('message.show');
                Route::put('/{message}', [MessageController::class, 'update'])->name('message.update');
                Route::delete('/{message}', [MessageController::class, 'destroy'])->name('message.destroy');
            });

            // Settings
            Route::get('all-settings', [SettingController::class, 'all_settings'])->name('all_settings.index');
            Route::put('all-settings', [SettingController::class, 'update'])->name('all_settings.update');
        });
    }
);
