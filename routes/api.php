<?php

/**
 * Portfolio Public REST API Routes
 *
 * All routes run under the 'api' and 'ApiSetting' middleware group (no API key required).
 * Exposes read-only v1 endpoints for the standalone React (Vite) frontend and a
 * rate-limited contact submission endpoint.
 */

declare(strict_types=1);

use App\Http\Controllers\API\BlogController;
use App\Http\Controllers\API\CredentialController;
use App\Http\Controllers\API\ExperienceController;
use App\Http\Controllers\API\FaqController;
use App\Http\Controllers\API\HomeController;
use App\Http\Controllers\API\MessageController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\ServiceController;
use App\Http\Controllers\API\SettingController;
use App\Http\Controllers\API\StatController;
use App\Http\Controllers\API\TechnologyController;
use App\Http\Controllers\API\TestimonialController;
use Illuminate\Support\Facades\Route;

// Legacy contact message route preserved for backward compatibility
Route::post('/message', [MessageController::class, 'CreateMessage'])
    ->middleware('throttle:5,1')
    ->name('api.message.store');

// Public REST API v1
Route::prefix('v1')->name('api.v1.')->group(static function (): void {
    // Dynamic public settings & aggregated landing page
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::get('/home', [HomeController::class, 'index'])->name('home.index');

    // Projects & Case Studies
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/{slug}', [ProjectController::class, 'show'])->name('projects.show');

    // Technical Stack, Career Timeline, Credentials & Services
    Route::get('/technologies', [TechnologyController::class, 'index'])->name('technologies.index');
    Route::get('/experiences', [ExperienceController::class, 'index'])->name('experiences.index');
    Route::get('/credentials', [CredentialController::class, 'index'])->name('credentials.index');
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');

    // Testimonials, Categories, Blogs, FAQs & Stats
    Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
    Route::get('/categories', [BlogController::class, 'categories'])->name('categories.index');

    Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
    Route::get('/blogs/categories', [BlogController::class, 'categories'])->name('blogs.categories');
    Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('blogs.show');

    Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/categories', [BlogController::class, 'categories'])->name('blog.categories');
    Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

    Route::get('/faqs', [FaqController::class, 'index'])->name('faqs.index');
    Route::get('/stats', [StatController::class, 'index'])->name('stats.index');

    // Rate-limited Contact & Project Inquiry Submission
    Route::post('/contact', [MessageController::class, 'store'])
        ->middleware('throttle:5,1')
        ->name('contact.store');
});
