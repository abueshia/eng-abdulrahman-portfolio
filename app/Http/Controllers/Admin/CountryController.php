<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Country\CountryRequest;
use App\Models\Country;
use App\Services\CountryService;
use App\ViewModels\CountryViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class CountryController extends Controller
{
    private $country;

    public function __construct()
    {
        $this->country = new CountryService();
    //    $this->middleware('permission:countries.view_all', ['only' => ['index']]);
    //    $this->middleware('permission:countries.view_details', ['only' => ['show']]);
    //    $this->middleware('permission:countries.create', ['only' => ['create', 'store']]);
    //    $this->middleware('permission:countries.edit', ['only' => ['edit', 'update']]);
    //    $this->middleware('permission:countries.delete', ['only' => ['destroy']]);
    //    $this->middleware('permission:countries.sort', ['only' => ['reorder', 'saveReorder']]);

        $this->middleware(['auth:admin', 'permission:countries.view_all'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:countries.read'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:countries.create'], ['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:countries.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:countries.delete'], ['only' => ['destroy']]);
        $this->middleware(['auth:admin', 'permission:countries.sort'], ['only' => ['reorder', 'saveReorder']]);

    }

    /**
     * Display a listing of the category.
     */
    public function index(Request $request) : View
    {
//        $countrys  = Country::ordered()->paginate();
        return view('admin.pages.country.index');
    }

    //     public function table(DataTables $dataTables, Request $request) {
    //         $model = Country::ordered();
    //         return $dataTables->eloquent($model)->addIndexColumn()
    //             ->editColumn('id', function (Country $country) {
    //                 return $country->id ?? '-';
    //             })->editColumn('name', function (Country $country) {
    //                 return $country->name;
    //             })->editColumn('image', function (Country $country) {
    //                 return "<img width='100' src=' ".$country->getFirstMediaUrl('countries')." '/>";
    // //            })->editColumn('code', function (Country $country) {
    // //                return $country->code ?? '-';
    //             })->editColumn('created_at', function (Country $country) {
    //                 return $country->created_at->format('d-m-Y h:i A') ?? '-';
    //             })->addColumn('action', function (Country $country) {
    //                 return view('admin.pages.country.buttons', compact('country'));
    //             })
    //             ->rawColumns(['image','action'])
    //             ->startsWithSearch()
    //             ->make(true);
    //     }

    public function table(DataTables $dataTables, Request $request)
    {
        $model = Country::ordered();

        return $dataTables->eloquent($model)->addIndexColumn()
            ->editColumn('id', function (Country $country) {
                return $country->id ?? '-';
            })->editColumn('name', function (Country $country) {
                return $country->name;
            })->editColumn('image', function (Country $country) {
                return "<img width='100' src=' " . $country->getFirstMediaUrl('countries') . " '/>";
            })->editColumn('created_at', function (Country $country) {
                return $country->created_at->format('d-m-Y') ?? '-';
            })->addColumn('action', function (Country $country) {
                return view('admin.pages.country.buttons', compact('country'));
            })
            ->filterColumn('name', function ($query, $keyword) {
                $query->where('name', 'LIKE', "%$keyword%");
            })
            ->rawColumns(['image', 'action'])
            ->startsWithSearch()
            ->make(true);
    }

    
    /**
     * Display a Single Row of the resource.
     */
    public function Show($id): View
    {
        $country = Country::find($id);
        return view('admin.pages.country.show' , get_defined_vars());
    }

    /**
     * Show the form for creating a new category.
     */
    public function create() : View
    {
        return view('admin.pages.country.form' ,  new CountryViewModel());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CountryRequest $request) : RedirectResponse
    {
        // dd($request->validated());
        $this->country->createCountry($request->validated());
        session()->flash('success', TranslationHelper::translate('Operation Success'));
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country) : View
    {
        return view('admin.pages.country.form' ,  new CountryViewModel($country));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CountryRequest $request, Country $country) : RedirectResponse
    {
//        return $request;
        $this->country->updateCountry($country , $request->validated());
        session()->flash('success', TranslationHelper::translate('Successfully Updated'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country) : JsonResponse
    {
        $this->country->deleteCountry($country);
        return response()->json(['status' => 'success', 'message' => TranslationHelper::translate('Successfully Deleted')]);

    }

    public function reorder(Country $country) {
        return $this->country->reorder($country, 'name', 'admin.pages.country.reorder', 1);
    }

    public function saveReorder(Request $request, Country $country) {
        $all_entries = \Request::input('tree');
        return $this->country->saveReorder($all_entries, $country);
    }

}
