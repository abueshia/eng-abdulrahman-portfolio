<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\City\CityRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Region;
use App\Services\CityService;
use App\ViewModels\CityViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class CityController extends Controller
{
    private $city;

    public function __construct()
    {
        $this->city = new CityService();
        //    $this->middleware('permission:cities.view_all', ['only' => ['index']]);
        //    $this->middleware('permission:cities.view_details', ['only' => ['show']]);
        //    $this->middleware('permission:cities.create', ['only' => ['create', 'store']]);
        //    $this->middleware('permission:cities.edit', ['only' => ['edit', 'update']]);
        //    $this->middleware('permission:cities.delete', ['only' => ['destroy']]);
        //    $this->middleware('permission:cities.sort', ['only' => ['reorder', 'saveReorder']]);

        $this->middleware(['auth:admin', 'permission:cities.view_all'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:cities.read'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:cities.create'], ['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:cities.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:cities.delete'], ['only' => ['destroy']]);
        $this->middleware(['auth:admin', 'permission:cities.sort'], ['only' => ['reorder', 'saveReorder']]);

    }

    /**
     * Display a listing of the category.
     */
    public function index(Request $request) : View
    {
//        $citys  = City::ordered()->paginate();

        return view('admin.pages.city.index');
    }

    public function getCityByCountry($country)
    {
        $cities = City::where('country_id', $country)->pluck('name', 'id');
        return response()->json($cities);
    }
    public function getRegionsByCity($city)
    {
        $regions = Region::where('city_id', $city)->pluck('name', 'id');

        return response()->json($regions);
    }

    public function table(DataTables $dataTables, Request $request) {
        $model = City::ordered();
        return $dataTables->eloquent($model)->addIndexColumn()

            ->filter(function ($query) use ($request) {
                // Custom search logic
                if ($search = $request->get('search')['value']) {
                    $query->where(function ($q) use ($search) {
                        $q->where('name->en', 'like', '%' . $search . '%')
                        ->orWhere('name->ar', 'like', '%' . $search . '%')
                            ->orWhereHas('country', function ($q) use ($search) {
                                $q->where('name->en', 'like', '%' . $search . '%')
                        ->orWhere('name->ar', 'like', '%' . $search . '%');
                            });
                    });
                }
            })
            ->editColumn('id', function (City $city) {
                return $city->id ?? '-';
            })->editColumn('name', function (City $city) {
                return $city->name;
            })->editColumn('country_name', function (City $city) {
                return $city->country->name ?? '-';
            })->editColumn('created_at', function (City $city) {
                return $city->created_at->format('d-m-Y') ?? '-';
            })->addColumn('action', function (City $city) {
                return view('admin.pages.city.buttons', compact('city'));
            })
            ->rawColumns(['image','action'])
            ->startsWithSearch()
            ->make(true);
    }
    /**
     * Display a Single Row of the resource.
     */
    public function Show($id): View
    {
        $city = City::find($id);
        return view('admin.pages.city.show' , get_defined_vars());
    }

    /**
     * Show the form for creating a new category.
     */
    public function create() : View
    {
        $countries = Country::get();
        return view('admin.pages.city.form' ,  new CityViewModel(), get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CityRequest $request) : RedirectResponse
    {
        $this->city->createCity($request->validated());
        session()->flash('success', TranslationHelper::translate('Operation Success'));
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city) : View
    {
        $countries = Country::get();

        return view('admin.pages.city.form' ,  new CityViewModel($city), get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CityRequest $request, City $city) : RedirectResponse
    {
//        return $request;
        $this->city->updateCity($city , $request->validated());
        session()->flash('success', TranslationHelper::translate('Successfully Updated'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city) : JsonResponse
    {
        $this->city->deleteCity($city);
        return response()->json(['status' => 'success', 'message' => TranslationHelper::translate('Successfully Deleted')]);

    }

    public function reorder(City $city) {
        return $this->city->reorder($city, 'name', 'admin.pages.city.reorder', 1);
    }

    public function saveReorder(Request $request, City $city) {
        $all_entries = \Request::input('tree');
        return $this->city->saveReorder($all_entries, $city);
    }

}
