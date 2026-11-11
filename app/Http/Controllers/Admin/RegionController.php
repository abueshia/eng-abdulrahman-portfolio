<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Region\RegionRequest;
use App\Models\City;
use App\Models\Region;
use App\Models\Country;
use App\Services\RegionService;
use App\ViewModels\RegionViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class RegionController extends Controller
{
    private $region;

    public function __construct()
    {
        $this->region = new RegionService();
        //    $this->middleware('permission:regions.view_all', ['only' => ['index']]);
        //    $this->middleware('permission:regions.view_details', ['only' => ['show']]);
        //    $this->middleware('permission:regions.create', ['only' => ['create', 'store']]);
        //    $this->middleware('permission:regions.edit', ['only' => ['edit', 'update']]);
        //    $this->middleware('permission:regions.delete', ['only' => ['destroy']]);
        //    $this->middleware('permission:regions.sort', ['only' => ['reorder', 'saveReorder']]);


        $this->middleware(['auth:admin', 'permission:regions.read'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:regions.read'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:regions.create'], ['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:regions.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:regions.delete'], ['only' => ['destroy']]);
        $this->middleware(['auth:admin', 'permission:regions.sort'], ['only' => [
            'reorder',
            'saveReorder'
        ]]);

    }

    /**
     * Display a listing of the category.
     */
    public function index(Request $request) : View
    {
        return view('admin.pages.region.index');
    }

    // public function table(DataTables $dataTables, Request $request) {
    //     $model = Region::ordered();

    //     return $dataTables->eloquent($model)->addIndexColumn()
    //         ->editColumn('id', function (Region $region) {
    //             return $region->id ?? '-';
    //         })->editColumn('name', function (Region $region) {
    //             return $region->name;
    //         })->editColumn('city_name', function (Region $region) {
    //             return $region->city->name ?? '-';
    //         })->editColumn('created_at', function (Region $region) {
    //             return $region->created_at->format('d-m-Y h:i A') ?? '-';
    //         })->addColumn('action', function (Region $region) {
    //             return view('admin.pages.region.buttons', compact('region'));
    //         })
    //         ->rawColumns(['image','action'])
    //         ->startsWithSearch()
    //         ->make(true);
    // }

    public function table(DataTables $dataTables, Request $request) {
    $model = Region::ordered();

    return $dataTables->eloquent($model)->addIndexColumn()
        ->editColumn('id', function (Region $region) {
            return $region->id ?? '-';
        })->editColumn('name', function (Region $region) {
            return $region->name;
        })->editColumn('city_name', function (Region $region) {
            return $region->city->name ?? '-';
        })->editColumn('created_at', function (Region $region) {
            return $region->created_at->format('d-m-Y') ?? '-';
        })->addColumn('action', function (Region $region) {
            return view('admin.pages.region.buttons', compact('region'));
        })
        // فلتر للبحث في حقل الاسم
        ->filterColumn('name', function ($query, $keyword) {
            $query->where('name', 'LIKE', "%$keyword%");
        })
        // فلتر للبحث في حقل اسم المدينة
        ->filterColumn('city_name', function ($query, $keyword) {
            $query->whereHas('city', function ($subQuery) use ($keyword) {
                $subQuery->where('name', 'LIKE', "%$keyword%");
            });
        })
        ->rawColumns(['action'])
        ->startsWithSearch()
        ->make(true);
}


    /**
     * Display a Single Row of the resource.
     */
    public function Show($id): View
    {
        $region = Region::find($id);
        return view('admin.pages.region.show' , get_defined_vars());
    }

    /**
     * Show the form for creating a new category.
     */
    public function create() : View
    {
        $cities = City::get();
        return view('admin.pages.region.form' ,  new RegionViewModel(), get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegionRequest $request) : RedirectResponse
    {
        $this->region->createRegion($request->validated());
        session()->flash('success', TranslationHelper::translate('Operation Success'));
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Region $region) : View
    {
        $cities = City::get();

        return view('admin.pages.region.form' ,  new RegionViewModel($region), get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RegionRequest $request, Region $region) : RedirectResponse
    {
//        return $request;
        $this->region->updateRegion($region , $request->validated());
        session()->flash('success', TranslationHelper::translate('Successfully Updated'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Region $region) : JsonResponse
    {
        $this->region->deleteRegion($region);
        return response()->json(['status' => 'success', 'message' => TranslationHelper::translate('Successfully Deleted')]);

    }

    public function reorder(Region $region) {
        return $this->region->reorder($region, 'name', 'admin.pages.region.reorder', 1);
    }

    public function saveReorder(Request $request, Region $region) {
        $all_entries = \Request::input('tree');
        return $this->region->saveReorder($all_entries, $region);
    }

}
