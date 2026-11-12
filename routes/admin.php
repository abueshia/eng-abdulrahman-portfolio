<?php

/**
 * Admin Dashboard Routes
 *
 * Defines localized and authenticated routes for the Portfolio Admin CMS.
 * Additional portfolio modules (Projects, Technologies, Experiences, Credentials,
 * Services, FAQs, Stats, Dynamic Settings) will be registered in Phase 3 & Phase 5.
 */

declare(strict_types=1);

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
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

            // Contact Messages & Project Inquiries
            Route::group(['prefix' => 'message'], static function (): void {
                Route::get('/', [MessageController::class, 'index'])->name('message.index');
                Route::get('/table/show', [MessageController::class, 'table'])->name('message.table');
                Route::get('/{message}', [MessageController::class, 'show'])->name('message.show');
                Route::delete('/{message}', [MessageController::class, 'destroy'])->name('message.destroy');
            });

            // Settings
            Route::get('all-settings', [SettingController::class, 'all_settings'])->name('all_settings.index');
        });
    }
);
