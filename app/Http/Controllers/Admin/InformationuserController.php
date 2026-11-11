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

class InformationuserController extends Controller
{



            public function __construct()
    {

        // information_user
        // $this->middleware('permission:information_user.view_all', ['only' => ['index']]);
        // $this->middleware('permission:information_user.view_details', ['only' => ['show']]);
        // $this->middleware('permission:information_user.delete', ['only' => ['destroy']]);


        $this->middleware(['auth:admin', 'permission:information_user.view_all'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:information_user.view_details'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:information_user.delete'], ['only' => ['destroy']]);

        
    }

   
    public function index(Request $request)
    {
        $bookings = ProgrammeBooking::query();
        $users = User::get(); 
        
        $programmes = Programme::select('id', 'name')->get(); // جلب كل البرامج

        if ($request->has('user_id') && $request->user_id != '') {
            $bookings = $bookings->where('user_id', $request->user_id);
        }

        if ($request->has('programme_id') && $request->programme_id != ''
        ) {
            $bookings = $bookings->where('programme_id', $request->programme_id);
        }

        if ($request->has('from_date') && $request->from_date != '') {
            $bookings = $bookings->whereDate('check_in', '>=', $request->from_date);
        }

        if ($request->has('to_date') && $request->to_date != '') {
            $bookings = $bookings->whereDate('check_in', '<=', $request->to_date);
        }

        $bookings = $bookings->with('user', 'programme')->paginate(15);

        $usersWithBookingCount = User::withCount('programmebooking')->get();

        $usersBookingCountMap = $usersWithBookingCount->pluck('programmebooking_count', 'id');

        return view('admin.pages.informationuser.index', compact('bookings', 'users', 'programmes', 'usersWithBookingCount', 'usersBookingCountMap'));
    }



    public function show($booking) {
        $booking = ProgrammeBooking::with('programme', 'user')->find($booking);
        return view('admin.pages.informationuser.show', get_defined_vars());
    }



    public function destroy(ProgrammeBooking $booking) {
        $booking->delete();
        return redirect()->route('admin.informationuser.index')->with(['success' => 'Booking Request Deleted Successfully']);
    }
}
