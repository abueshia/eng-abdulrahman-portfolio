<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Client;
use App\Models\Order;
use App\Models\ProgrammeBooking;
use App\Models\Provider;
use App\Models\Region;
use App\Models\Service;
use App\Models\User;


class DashboardController extends Controller
{
    // public function index()
    // {
    //     $admins_count = 0;
    //     $users_count = 0;
    //     $orders_count = 0;

    //     $providers_count = 0;
    //     $services_count = 0;
    //     $regoins_count = 0;

    //     $totalBookings = \App\Models\ProgrammeBooking::count();
    //     $blogs = \App\Models\Blog::count();
    //     $programmes = \App\Models\Programme::count();
    //     $uniqueUserCount = \App\Models\ProgrammeBooking::distinct('user_id')->count('user_id');



    //     $bookings = \App\Models\ProgrammeBooking::select(
    //         'programme_bookings.user_id',
    //         'programme_bookings.check_in',
    //         'programme_bookings.programme_id',
    //         'programmes.duration as programme_duration'
    //     )
    //     ->join('programmes', 'programme_bookings.programme_id', '=', 'programmes.id')
    //     ->orderBy('programme_bookings.created_at', 'desc') // ترتيب النتائج حسب تاريخ الحجز من الأحدث إلى الأقدم
    //     ->get();

    //     return view('admin.index', get_defined_vars());
    // }

    public function index()
    {
        $totalBookings = \App\Models\Message::where('type', 'booking')->count();
        $totalMessages = \App\Models\Message::whereNull('type')->orWhere('type', 'contact')->count();
        $totalTestimonials = \App\Models\Testimonial::count();
        
        $latestBookings = \App\Models\Message::where('type', 'booking')->latest()->take(5)->get();
        $latestMessages = \App\Models\Message::whereNull('type')->orWhere('type', 'contact')->latest()->take(5)->get();
        $latestTestimonials = \App\Models\Testimonial::latest()->take(5)->get();

        return view('admin.index', get_defined_vars());
    }








    public function landing_cms() {
        $check = auth()->check();
        $admin = auth()->user();
        if ($check && $admin->is_admin == 1) {
            $url = config('landing_dashboard.login_url');
            return redirect($url);
        } else {
            session()->flash('error', TranslationHelper::translate('Unauthorized To Login'));
            return back();
        }
    }


    public function getTopProgrammesBookings()
    {
        $topProgrammes = ProgrammeBooking::select('programme_id')
        ->with('programme:id,name') // جلب أسماء البرامج
        ->selectRaw('COUNT(*) as total_bookings') // حساب عدد الحجوزات لكل برنامج
        ->groupBy('programme_id')
        ->orderByDesc('total_bookings')
        ->take(5) 
            ->get();

        return response()->json($topProgrammes); // إرجاع البيانات بصيغة JSON
    }
}
