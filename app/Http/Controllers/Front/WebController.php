<?php

/**
 * Frontend WebController
 *
 * Handles public-facing portfolio pages and contact/project inquiry submissions.
 * Will be connected to the new Portfolio Services in Phase 4 & Phase 7.
 */

declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Enums\ContactMessageStatusEnum;
use App\Enums\ContactMessageTypeEnum;
use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Testimonial;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class WebController extends Controller
{
    /**
     * Display the portfolio home page.
     */
    public function index(): View
    {
        $about = null;
        $banners = collect();
        $testimonials = Testimonial::query()->latest()->take(5)->get();

        return view('front.index', compact('about', 'banners', 'testimonials'));
    }

    /**
     * Display the portfolio projects / case studies page.
     */
    public function cases(): View
    {
        $cases = new LengthAwarePaginator([], 0, 20);

        return view('front.pages.cases', compact('cases'));
    }

    /**
     * Display the about page for Eng. Abdelrahman Abu Aishah.
     */
    public function about(): View
    {
        $about = null;

        return view('front.pages.about', compact('about'));
    }

    /**
     * Display the software engineering services page.
     */
    public function services(): View
    {
        return view('front.pages.services');
    }

    /**
     * Display the contact and project inquiry page.
     */
    public function message_contact(): View
    {
        $contact = null;

        return view('front.pages.message', compact('contact'));
    }

    /**
     * Store a new contact message or project inquiry from the public form.
     */
    public function store(Request $request): RedirectResponse
    {
        if (! empty($request->website_url)) {
            return back();
        }

        $isBooking = $request->type === 'booking';

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => $isBooking ? 'nullable|email|max:255' : 'required|email|max:255',
            'message' => $isBooking ? 'nullable|string' : 'required|string',
            'type' => 'nullable|in:contact,booking',
            'service' => 'nullable|string|max:255',
        ], [
            'name.required' => TranslationHelper::translate('Please enter your name'),
            'name.string' => TranslationHelper::translate('Name must be a valid string'),
            'name.max' => TranslationHelper::translate('Name must not be more than 255 characters'),
            'email.required' => TranslationHelper::translate('Please enter your email'),
            'email.email' => TranslationHelper::translate('Email must be a valid email address'),
            'email.max' => TranslationHelper::translate('Email must not be more than 255 characters'),
            'phone.required' => TranslationHelper::translate('Please enter your phone number'),
            'phone.string' => TranslationHelper::translate('Phone number must be a valid string'),
            'phone.max' => TranslationHelper::translate('Phone number must not exceed 20 characters'),
            'message.required' => TranslationHelper::translate('Please enter your message'),
            'message.string' => TranslationHelper::translate('Message must be a valid string'),
        ]);

        ContactMessage::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'type' => $isBooking
                ? ContactMessageTypeEnum::ProjectInquiry
                : ContactMessageTypeEnum::GeneralContact,
            'status' => ContactMessageStatusEnum::New,
            'service' => $request->service,
            'ip_address' => $request->ip(),
            'user_agent' => (string) $request->userAgent(),
        ]);

        try {
            $htmlContent = "<div dir='rtl' style='font-family: Tahoma, Arial, sans-serif;'>";
            $htmlContent .= "<h3 style='color: #B8863A;'>إشعار بطلب مشروع / تواصل جديد من الموقع</h3>";
            $htmlContent .= '<p><strong>الاسم:</strong> '.e((string) $request->name).'</p>';
            $htmlContent .= '<p><strong>رقم الهاتف:</strong> '.e((string) $request->phone).'</p>';
            if ($request->email) {
                $htmlContent .= '<p><strong>البريد الإلكتروني:</strong> '.e((string) $request->email).'</p>';
            }
            if ($request->service) {
                $htmlContent .= '<p><strong>الخدمة / المشروع المطلوب:</strong> '.e((string) $request->service).'</p>';
            }
            if ($request->message) {
                $htmlContent .= '<p><strong>تفاصيل المشروع / الرسالة:</strong> '.e((string) $request->message).'</p>';
            }
            $htmlContent .= "<br><hr><p style='font-size: 12px; color: #777;'>هذه الرسالة تم إرسالها تلقائياً من موقع المهندس عبدالرحمن أبو عيشة (Eng. Abdelrahman Abu Aishah Portfolio).</p></div>";

            Mail::html($htmlContent, static function ($mail): void {
                $mail->to(config('mail.from.address', 'info@abdelrahman-portfolio.com'))
                    ->subject('🔔 طلب مشروع / تواصل جديد من موقع م. عبدالرحمن أبو عيشة');
            });
        } catch (Exception $e) {
            Log::error('Mail sending failed: '.$e->getMessage());
        }

        session()->flash('success', 'تم إرسال طلبك بنجاح! سيتواصل معك المهندس عبدالرحمن أبو عيشة قريباً.');

        return redirect()->back();
    }
}
