<?php

namespace App\Http\Controllers\Admin;
use App\Models\Programme;
use App\Models\ProgrammeRate;
use App\Models\Rate;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ProgrammeRateController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
        // $this->middleware('permission:programme_rates.read', ['only' => ['index']]);
        // $this->middleware('permission:programme_rates.delete', ['only' => ['destroy']]);


        $this->middleware(['auth:admin', 'permission:programme_rates.read'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:programme_rates.delete'], ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $programmes = Programme::select('id', 'name')->get();

        $rates = ProgrammeRate::query();

        if ($request->has('programme_id') && $request->programme_id != '') {
            $rates = $rates->where('programme_id',   $request->programme_id  );
        }

        if ($request->has('status') && $request->status != '') {
            $rates = $rates->where('status',   $request->status  );
        }


        $rates = $rates->with('programme')->paginate(15);
        return view('admin.pages.programme_rate.index', get_defined_vars());
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
            $rate = ProgrammeRate::find($request->id);
            if ($rate->status == 0) {
                $rate->update(['status' => 1]);
            } else {
                $rate->update(['status' => 0]);
            }
            updateProgrammeRateAvg($rate->programme);


            return response()->json(['status' => 1, 'msg' => 'Status Successfully Changed', 'data' => [$rate->status]]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => 0, 'msg' => 'Some Error Happened']);
        }
    }
}
