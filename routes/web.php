<?php

/**
 * Public Web Routes
 *
 * Defines localized frontend routes for Eng. Abdelrahman Abu Aishah's Portfolio
 * as well as the XML sitemap endpoint.
 */

declare(strict_types=1);

use App\Http\Controllers\Front\BlogController;
use App\Http\Controllers\Front\WebController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ],
    static function (): void {
        Route::get('/', [WebController::class, 'index'])->name('site.home');
        Route::get('/about', [WebController::class, 'about'])->name('about');
        Route::get('/cases', [WebController::class, 'cases'])->name('cases.index');
        Route::get('/services', [WebController::class, 'services'])->name('services');
        Route::get('/contact-us', [WebController::class, 'message_contact'])->name('message_contact');
        Route::post('/contact-us', [WebController::class, 'store'])->name('create_message');
        Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
    }
);

require __DIR__.'/auth.php';

Route::get('/sitemap.xml', static function () {
    $baseUrl = rtrim(url('/'), '/');
    $content = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>'.$baseUrl.'/</loc>
        <lastmod>2026-11-12</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>'.$baseUrl.'/services</loc>
        <lastmod>2026-11-12</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc>'.$baseUrl.'/cases</loc>
        <lastmod>2026-11-12</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>'.$baseUrl.'/blogs</loc>
        <lastmod>2026-11-12</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc>'.$baseUrl.'/about</loc>
        <lastmod>2026-11-12</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>'.$baseUrl.'/contact-us</loc>
        <lastmod>2026-11-12</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
</urlset>';

    return response($content, 200)
        ->header('Content-Type', 'text/xml');
})->name('sitemap');
