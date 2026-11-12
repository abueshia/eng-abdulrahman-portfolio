<?php

/**
 * Admin DashboardController
 *
 * Displays key portfolio metrics, recent project inquiries, contact messages,
 * and client testimonials on the main admin dashboard home screen.
 */

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Enums\ContactMessageTypeEnum;
use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Testimonial;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    /**
     * Render the main admin dashboard with portfolio statistics.
     */
    public function index(): View
    {
        $totalBookings = ContactMessage::query()
            ->whereIn('type', [ContactMessageTypeEnum::ProjectInquiry->value, 'booking'])
            ->count();

        $totalMessages = ContactMessage::query()
            ->where(static function ($query): void {
                $query->whereNull('type')
                    ->orWhereIn('type', [
                        ContactMessageTypeEnum::GeneralContact->value,
                        ContactMessageTypeEnum::JobOffer->value,
                        ContactMessageTypeEnum::Consultation->value,
                        'contact',
                    ]);
            })
            ->count();

        $totalTestimonials = Testimonial::query()->count();

        $latestBookings = ContactMessage::query()
            ->whereIn('type', [ContactMessageTypeEnum::ProjectInquiry->value, 'booking'])
            ->latest()
            ->take(5)
            ->get();

        $latestMessages = ContactMessage::query()
            ->where(static function ($query): void {
                $query->whereNull('type')
                    ->orWhereIn('type', [
                        ContactMessageTypeEnum::GeneralContact->value,
                        ContactMessageTypeEnum::JobOffer->value,
                        ContactMessageTypeEnum::Consultation->value,
                        'contact',
                    ]);
            })
            ->latest()
            ->take(5)
            ->get();

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
