<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingsController extends Controller
{
    public function __construct()
    {
               $this->middleware('auth:admin');
        //        $this->middleware('permission:bookings.read', ['only' => ['index']]);
        //        $this->middleware('permission:bookings.create', ['only' => ['create', 'store']]);
        //        $this->middleware('permission:bookings.delete', ['only' => ['destroy']]);

        $this->middleware(['auth:admin', 'permission:bookings.read'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:bookings.create'], ['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:bookings.delete'], ['only' => ['destroy']]);


    }
    public function index(Request $request)
    {
//        return $request;
        $bookings = Booking::query();
        $users = User::get();
        $hotels = Hotel::select('id', 'name')->get();
        $rooms = Room::select('id', 'name')->get();


        if ($request->has('user_id') && $request->user_id != '') {
            $bookings = $bookings->where('user_id',   $request->user_id  );
        }

        if ($request->has('hotel_id') && $request->hotel_id != '') {
            $bookings = $bookings->where('hotel_id',   $request->hotel_id  );
        }
//
        if ($request->has('room_id') && $request->room_id != '') {
            $bookings = $bookings->where('room_id',   $request->room_id  );
        }
//
//
        if ($request->has('from_date') && $request->from_date != '') {
            $bookings = $bookings->whereDate('check_in', '>=',  $request->from_date );
        }
        if ($request->has('to_date') && $request->to_date != '') {
            $bookings = $bookings->whereDate('check_in', '<=',  $request->to_date );
        }


        $bookings = $bookings->with('hotel', 'room', 'user')->paginate(15);
//        return $bookings;
        return view('admin.pages.bookings.index', get_defined_vars());
    }

    public function show(Booking $booking)
    {
//        return $booking;
        return view('dashboard.pages.bookings.show', get_defined_vars());
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('admin.bookings.index')->with(['success' => 'Booking Request Deleted Successfully']);
    }

    public function changeStatus(Request $request) {
        try {
            $booking = Booking::find($request->id);
            if ($booking->payment_status == 'unpaid') {
                $booking->update(['payment_status' => 'paid']);
            } else {
                $booking->update(['payment_status' => 'unpaid']);
            }
            return response()->json(['status' => 1, 'msg' => 'Payment Status Successfully Changed', 'data' => [$booking->status]]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => 0, 'msg' => 'Some Error Happened']);
        }
    }
}
