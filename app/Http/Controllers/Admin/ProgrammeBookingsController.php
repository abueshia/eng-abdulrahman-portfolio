<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Hotel;
use App\Models\Programme;
use App\Models\ProgrammeBooking;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

class ProgrammeBookingsController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth:admin');
    //     $this->middleware('permission:programme_rates.read', ['only' => ['index']]);
    //     $this->middleware('permission:programme_rates.delete', ['only' => ['destroy']]);
    // }

    public function __construct()
    {
        $this->middleware('auth:admin');
        // $this->middleware('permission:programmes_bookings.read', ['only' => ['index']]);
        // $this->middleware('permission:programmes_bookings.create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:programmes_bookings.edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:programmes_bookings.delete', ['only' => ['destroy']]);


        $this->middleware(['auth:admin', 'permission:programmes_bookings.read'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:programmes_bookings.show'], ['only' => ['show']]);
        
        $this->middleware(['auth:admin', 'permission:programmes_bookings.create'], ['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:programmes_bookings.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:programmes_bookings.delete'], ['only' => ['destroy']]);

        // $this->blog = new BlogService();
    }


    public function index(Request $request)
    {
        $bookings = ProgrammeBooking::query();


        $users = User::get();
        $programmes = Programme::select('id', 'name')->get();


        if ($request->has('user_id') && $request->user_id != '') {
            $bookings = $bookings->where('user_id',   $request->user_id  );
        }

        if ($request->has('programme_id') && $request->programme_id != '') {
            $bookings = $bookings->where('programme_id',   $request->programme_id  );
        }
//
        if ($request->has('from_date') && $request->from_date != '') {
            $bookings = $bookings->whereDate('check_in', '>=',  $request->from_date );
        }
        if ($request->has('to_date') && $request->to_date != '') {
            $bookings = $bookings->whereDate('check_in', '<=',  $request->to_date );
        }

        $bookings = $bookings->with('programme', 'user')->paginate(15);


//        return $bookings;
        return view('admin.pages.programme_bookings.index', get_defined_vars());
    }

    public function show($booking) {
        $booking = ProgrammeBooking::with('programme', 'user')->find($booking);
        return view('admin.pages.programme_bookings.show', get_defined_vars());
    }

    public function destroy(ProgrammeBooking $booking) {
        $booking->delete();
        return redirect()->route('admin.programme_bookings.index')->with(['success' => 'Booking Request Deleted Successfully']);
    }
}
