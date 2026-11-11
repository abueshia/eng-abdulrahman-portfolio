<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Branche\BrancheRequest;
use App\Models\Branche;
use App\Models\City;
use App\Services\BrancheService;
use App\ViewModels\BrancheViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class BrancheController extends Controller
{
    private $branche;

    public function __construct()
    {
        $this->middleware(['auth:admin', 'permission:branche.view_all'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:branche.view_details'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:branche.create'], ['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:branche.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:branche.delete'], ['only' => ['destroy']]);
        $this->middleware(['auth:admin', 'permission:branche.sort'], ['only' => [
            'reorder',
            'saveReorder'
        ]]);
        $this->branche = new BrancheService();
    }

    public function getCityByCountry($city)
    {
        $branche = Branche::where('city_id', $city)->pluck('name', 'id');
        return response()->json($branche);
    }

    // public function getRegionsByCity($city)
    // {
    //     $regions = Region::where('city_id', $city)->pluck('name', 'id');
    //     return response()->json($regions);
    // }
    

    /**
     * Display a listing of the branche.
     */
    public function index(Request $request): View
    {
        // dd($request->all());
        $cities = City::all();
        return view('admin.pages.branche.index' , get_defined_vars());
    }

public function table(DataTables $dataTables, Request $request)
{
    $model = Branche::query()->with('city'); // تضمين العلاقة مع جدول المدن

    // إذا كان هناك طلب بحث عام حسب الاسم
    if ($request->has('name') && !empty($request->name)) {
        $search = $request->name;
        $model = $model->where('name', 'LIKE', '%' . $search . '%');
    }

    // إذا كان هناك طلب بحث حسب المدينة
    if ($request->has('city_id') && !empty($request->city_id)) {
        $model = $model->where('city_id', $request->city_id); // تعديل هنا للبحث باستخدام city_id
    }

    // إذا كان هناك طلب بحث حسب التاريخ
    if ($request->has('created_at') && !empty($request->created_at)) {
        $model = $model->whereDate('created_at', $request->created_at); // تعديل هنا للتصفية حسب التاريخ
    }

    // ترتيب البيانات حسب id تنازليًا (الأحدث أولًا)
    $model = $model->orderBy('id', 'desc');

    return $dataTables->eloquent($model)
        ->addIndexColumn()
        ->editColumn('id', function (Branche $branche) {
            return $branche->id ?? '-';
        })
        ->editColumn('name', function (Branche $branche) {
            return $branche->name ?? '-';
        })
        ->editColumn('image', function (Branche $branche) {
            $imageUrl = $branche->getFirstMediaUrl('branches') ?: asset('path/to/default/image.jpg');
            return "<img width='100' src='{$imageUrl}' alt='Branche Image'/>";
        })
        ->editColumn('city.name', function (Branche $branche) {
            return $branche->city->name ?? '-';
        })
        ->editColumn('created_at', function (Branche $branche) {
            return $branche->created_at ? $branche->created_at->format('d-m-Y') : '-';
        })
        ->addColumn('action', function (Branche $branche) {
            return view('admin.pages.branche.buttons', compact('branche'));
        })
        ->rawColumns(['image', 'action'])
        ->make(true);
}



    /**
     * Display a Single Row of the resource.
     */
    public function Show($id): View
    {
        $branche = Branche::find($id);
        return view('admin.pages.branche.show', get_defined_vars());
    }

    /**
     * Show the form for creating a new branche.
     */
    public function create(): View
    {
        $cities = City::all(); 
        return view('admin.pages.branche.form',  new BrancheViewModel(), get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrancheRequest $request)
    {
        // return $request;
        $this->branche->createBranche($request->validated());
        session()->flash('success', TranslationHelper::translate('Operation Success'));
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branche $branche): View
    {
        $cities = City::get(); 
        return view('admin.pages.branche.form',  new BrancheViewModel($branche), get_defined_vars());

    }
 
    /**
     * Update the specified resource in storage.
     */
    public function update(BrancheRequest $request, Branche $branche): RedirectResponse
    {
        //        return $request;
        $this->branche->updateBranche($branche, $request->validated());
        session()->flash('success', TranslationHelper::translate('Successfully Updated'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branche $branche): JsonResponse
    {
        $this->branche->deleteBranche($branche);
        return response()->json(['status' => 'success', 'message' => TranslationHelper::translate('Successfully Deleted')]);
    }

    public function reorder(Branche $branche)
    {
        return $this->branche->reorder($branche, 'name', 'admin.pages.branche.reorder', 1);
    }

    public function saveReorder(Request $request, Branche $branche)
    {
        $all_entries = $request->input('tree');
        return $this->branche->saveReorder($all_entries, $branche);
    }
}
