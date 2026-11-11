<?php

use App\Http\Controllers\Front\ProgrammeController;
use App\Http\Controllers\Front\BlogController;
use App\Http\Controllers\Front\DashboardController;
use App\Http\Controllers\Front\FlightController;
use App\Http\Controllers\Front\HotelController;
use App\Http\Controllers\Front\WebController;
use App\Http\Controllers\Front\AuthController;
use App\Http\Controllers\Front\ProgramController;
use App\Http\Controllers\Front\WishController;
use App\Models\Programme;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('test', function () {
    Cache::forget('settings');
    Cache::rememberForever('settings', function () {
        return Setting::get();
    });
});

Route::group(
    ['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],
    function () {
        Route::get('/', [WebController::class, 'index'])->name('site.home');
        Route::get('/about', [WebController::class, 'about'])->name('about');
        Route::get('/cases', [WebController::class, 'cases'])->name('cases.index');
        Route::get('/services', [WebController::class, 'services'])->name('services');
        Route::get('/contact-us', [WebController::class, 'message_contact'])->name('message_contact');
        Route::post('/contact-us', [WebController::class, 'store'])->name('create_message');
        Route::post('/create-testimonial', [WebController::class, 'store_testimonial'])->name('create_testimonial');
        Route::get('/termsandcondition', [WebController::class, 'termsandcondition'])->name('termsandcondition');

        Route::get('/brands', [WebController::class, 'brands'])->name('brands');

        Route::get('/products', [WebController::class, 'products'])->name('products');
        Route::get('/products/category/{id}', [WebController::class, 'showByCategory'])->name('products.byCategory');

        Route::get('/products/{id}', [WebController::class, 'productDetails'])->name('products.details');

        Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');

    });

require __DIR__ . '/auth.php';

Route::get('/sitemap.xml', function () {
    $content = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>https://dr-mohamed-hamza.com/</loc>
        <lastmod>2026-09-17</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>https://dr-mohamed-hamza.com/services</loc>
        <lastmod>2026-09-17</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc>https://dr-mohamed-hamza.com/cases</loc>
        <lastmod>2026-09-17</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>https://dr-mohamed-hamza.com/blogs</loc>
        <lastmod>2026-09-17</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc>https://dr-mohamed-hamza.com/about</loc>
        <lastmod>2026-09-17</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>https://dr-mohamed-hamza.com/contact-us</loc>
        <lastmod>2026-09-17</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
</urlset>';

    return response($content, 200)
        ->header('Content-Type', 'text/xml');
});