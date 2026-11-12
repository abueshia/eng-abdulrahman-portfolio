<?php

/**
 * Admin DashboardController
 *
 * Displays key portfolio metrics, recent project inquiries, contact messages,
 * and client testimonials on the main admin dashboard home screen.
 */

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Testimonial;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    /**
     * Render the main admin dashboard with portfolio statistics.
     */
    public function index(): View
    {
        $totalBookings = Message::query()->where('type', 'booking')->count();
        $totalMessages = Message::query()->whereNull('type')->orWhere('type', 'contact')->count();
        $totalTestimonials = Testimonial::query()->count();

        $latestBookings = Message::query()->where('type', 'booking')->latest()->take(5)->get();
        $latestMessages = Message::query()->whereNull('type')->orWhere('type', 'contact')->latest()->take(5)->get();
        $latestTestimonials = Testimonial::query()->latest()->take(5)->get();

        return view('admin.index', compact(
            'totalBookings',
            'totalMessages',
            'totalTestimonials',
            'latestBookings',
            'latestMessages',
            'latestTestimonials'
        ));
    }
}
