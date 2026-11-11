<?php

namespace App\Http\Controllers\Front;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Front\Booking\ApplyFormRequest;
use App\Http\Requests\Front\Flight\FlightMultiSearchRequest;
use App\Http\Requests\Front\Flight\FlightSearchRequest;
use App\Http\Requests\Front\ProgrammeBooking\ProgrammeBookingCheckoutRequest;
use App\Models\About;
use App\Models\AirMaster;
use App\Models\Airport;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Categorygallery;
use App\Models\City;
use App\Models\Contact;
use App\Models\Country;
use App\Models\Gallery;
use App\Models\HotelCity;
use App\Models\Informationflight;
use App\Models\Informationhotel;
use App\Models\Informationtour;
use App\Models\Message;
use App\Models\Privacypolicy;
use App\Models\Product;
use App\Models\Productcategory;
use App\Models\Programme;
use App\Models\ProgrammeBooking;
use App\Models\Setting;
use App\Models\Tag;
use App\Models\Termsandcondition;
use App\Models\Testimonial;
use App\Models\TourType;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;
class WebController extends Controller
{
    public function index()
    {
        $about = About::first();
        $banners = Banner::latest()->take(15)->get();
        $brands = Gallery::get();
        $products = Product::orderBy('created_at', 'desc')->limit(12)->get();
        $testimonials = Testimonial::latest()->take(5)->get();
        return view('front.index', get_defined_vars());
    }

    public function cases()
    {
        $cases = Banner::latest()->paginate(20);
        return view('front.pages.cases', get_defined_vars());
    }



    public function gallery($id)
    {
        $category = Categorygallery::find($id);
        $galleries = Gallery::where('categorygallery_id', $id)->get();
        return view('front.pages.gallery', compact('category', 'galleries'));
    }


    public function photo_gallery()
    {
        $photoGallery = Categorygallery::get();
        return view('front.pages.photo_gallery', compact('photoGallery'));
    }


   

    public function all_about_us()
    {
        $about_us = Testimonial::all();
        $cities = City::with('country')->latest()->take(8)->get();
        return view('front.pages.about_us', get_defined_vars());
    }


    public function about()
    {
        $about = About::first();
        return view('front.pages.about', get_defined_vars());
    }

    public function services()
    {
        return view('front.pages.services');
    }


    public function privacypolicy()
    {
        $privacypolicy = Privacypolicy::first();
        return view('front.pages.privacypolicy', get_defined_vars());
    }

    public function termsandcondition()
    {
        $termsandcondition = Termsandcondition::first();
        return view('front.pages.termsandcondition', get_defined_vars());
    }





    public function store(Request $request)
    {
        // Honeypot check to block bots
        if (!empty($request->website_url)) {
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

        Message::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'type' => $request->type ?? 'contact',
            'service' => $request->service,
        ]);

        try {
            $html_content = "<div dir='rtl' style='font-family: Tahoma, Arial, sans-serif;'>";
            $html_content .= "<h3 style='color: #B8863A;'>إشعار بطلب حجز جديد من الموقع</h3>";
            $html_content .= "<p><strong>الاسم:</strong> " . $request->name . "</p>";
            $html_content .= "<p><strong>رقم الهاتف:</strong> " . $request->phone . "</p>";
            if ($request->email) {
                $html_content .= "<p><strong>البريد الإلكتروني:</strong> " . $request->email . "</p>";
            }
            if ($request->service) {
                $html_content .= "<p><strong>الخدمة المطلوبة:</strong> " . $request->service . "</p>";
            }
            if ($request->message) {
                $html_content .= "<p><strong>ملاحظات إضافية:</strong> " . $request->message . "</p>";
            }
            $html_content .= "<br><hr><p style='font-size: 12px; color: #777;'>هذه الرسالة تم إرسالها تلقائياً من نظام الحجز بموقع عيادة د. محمد حمزة.</p></div>";
            
            \Illuminate\Support\Facades\Mail::html($html_content, function ($mail) {
                $mail->to('info.dr.mohamed.hamza@gmail.com')
                     ->subject('🔔 طلب حجز جديد من موقع العيادة');
            });
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Mail sending failed: ' . $e->getMessage());
        }

        session()->flash('success', 'تم إرسال رسالتك بنجاح. سيتم التواصل معك قريباً.');
        return redirect()->back();
    }



    public function message_contact()
    {
        $contact = Contact::first();
        return view('front.pages.message', get_defined_vars());
    }


     public function brands()
    {
        $brands = Gallery::get();
        return view('front.pages.brands', get_defined_vars());
    }

    

}
