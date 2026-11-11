<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Dashboard\StoreCouponRequest;
use App\Models\Coupon;
use App\Models\Hotel;
use App\Models\Rate;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Dashboard\UpdateCouponRequest;

class RateController extends Controller
{

    public function __construct()
    {
    //     $this->middleware('auth:admin');
    //     $this->middleware('permission:hotel_rates.read', ['only' => ['index']]);
    //     $this->middleware('permission:hotel_rates.delete', ['only' => ['destroy']]);

        $this->middleware(['auth:admin', 'permission:hotel_rates.view_all'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:hotel_rates.view_details'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:hotel_rates.create'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:hotel_rates.edit'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:hotel_rates.delete'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:hotel_rates.sort'], ['only' => ['reorder', 'saveReorder']]);


                $this->middleware(['auth:admin', 'permission:hotel_rates.view_all'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:hotel_rates.view_details'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:hotel_rates.create'], ['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:hotel_rates.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:hotel_rates.delete'], ['only' => ['destroy']]);
        $this->middleware(['auth:admin', 'permission:hotel_rates.sort'], ['only' => [
            'reorder',
            'saveReorder'
        ]]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $hotels = Hotel::select('id', 'name')->get();

        $rates = Rate::query();

        if ($request->has('hotel_id') && $request->hotel_id != '') {
            $rates = $rates->where('hotel_id',   $request->hotel_id  );
        }

        if ($request->has('status') && $request->status != '') {
            $rates = $rates->where('status',   $request->status  );
        }


        $rates = $rates->with('hotel')->paginate(15);
        return view('admin.pages.rate.index', get_defined_vars());
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rate $rate)
    {
        if ($rate) {
            $rate->delete();
        }
        return redirect()->route('admin.rate.index');
    }
    public function changeStatus(Request $request) {
        try {
            $rate = Rate::find($request->id);
            if ($rate->status == 0) {
                $rate->update(['status' => 1]);
            } else {
                $rate->update(['status' => 0]);
            }
            updateHotelRateAvg($rate->hotel);


            return response()->json(['status' => 1, 'msg' => 'Status Successfully Changed', 'data' => [$rate->status]]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => 0, 'msg' => 'Some Error Happened']);
        }
    }
}
