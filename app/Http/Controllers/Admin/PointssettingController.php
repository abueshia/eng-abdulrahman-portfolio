<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Pointssetting\PointssettingRequest;
use App\Models\Pointssetting;
use App\Services\PointssettingService;
use App\ViewModels\PointssettingViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class PointssettingController extends Controller
{
    private $pointssetting;

    public function __construct()
    {
        // $this->middleware('permission:pointssetting_us.view_all', ['only' => ['index']]);
        // $this->middleware('permission:pointssetting_us.view_details', ['only' => ['show']]);
        // $this->middleware('permission:pointssetting_us.create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:pointssetting_us.edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:pointssetting_us.delete', ['only' => ['destroy']]);
      
        $this->middleware(['auth:admin', 'permission:pointssetting.view_all'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:pointssetting.view_details'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:pointssetting.create'],['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:pointssetting.edit'],['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:pointssetting.delete'], ['only' => ['destroy']]);
        $this->pointssetting = new PointssettingService();
    }

    /**
     * Display a listing of the pointssetting.
     */
    public function index(Request $request): View
    {
        // dd($request->all());
        return view('admin.pages.pointssetting.index');
    }

    public function table(DataTables $dataTables, Request $request)
    {
        $model = Pointssetting::ordered();

        return $dataTables->eloquent($model)->addIndexColumn()
            ->editColumn('id', function (Pointssetting $pointssetting) {
                return $pointssetting->id ?? '-';
                
            })->editColumn('image', function (Pointssetting $pointssetting) {
                return "<img width='100' src=' " . $pointssetting->getFirstMediaUrl('pointssettings') . " '/>";
        })->editColumn('invite_friend', function (Pointssetting $pointssetting) {
            return $pointssetting->invite_friend;

            })->editColumn('product_code', function (Pointssetting $pointssetting) {
                return $pointssetting->product_code;
         })->editColumn('new_registration', function (Pointssetting $pointssetting) {
            return $pointssetting->new_registration;
            

            })->editColumn('created_at', function (Pointssetting $pointssetting) {
                return $pointssetting->created_at->format('d-m-Y') ?? '-';
            })->addColumn('action', function (Pointssetting $pointssetting) {
                return view('admin.pages.pointssetting.buttons', compact('pointssetting'));
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
        $pointssetting = Pointssetting::find($id);
        return view('admin.pages.pointssetting.show', get_defined_vars());
    }

    /**
     * Show the form for creating a new pointssetting.
     */
    public function create(): View
    {
        return view('admin.pages.pointssetting.form',  new PointssettingViewModel());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PointssettingRequest $request)
    {
        // return $request;
        $this->pointssetting->createPointssetting($request->validated());
        session()->flash('success', TranslationHelper::translate('Operation Success'));
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pointssetting $pointssetting): View
    {
        return view('admin.pages.pointssetting.form',  new PointssettingViewModel($pointssetting));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PointssettingRequest $request, Pointssetting $pointssetting): RedirectResponse
    {
        //        return $request;
        $this->pointssetting->updatePointssetting($pointssetting, $request->validated());
        session()->flash('success', TranslationHelper::translate('Successfully Updated'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pointssetting $pointssetting): JsonResponse
    {
        $this->pointssetting->deletePointssetting($pointssetting);
        return response()->json(['status' => 'success', 'message' => TranslationHelper::translate('Successfully Deleted')]);
    }

    public function reorder(Pointssetting $pointssetting)
    {
        return $this->pointssetting->reorder($pointssetting, 'name', 'admin.pages.pointssetting.reorder', 1);
    }

    public function saveReorder(Request $request, Pointssetting $pointssetting)
    {
        $all_entries = $request->input('tree');
        return $this->pointssetting->saveReorder($all_entries, $pointssetting);
    }
}
