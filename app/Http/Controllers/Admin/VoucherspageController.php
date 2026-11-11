<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Voucherspage\VoucherspageRequest;
use App\Models\Voucherspage;
use App\Services\VoucherspageService;
use App\ViewModels\VoucherspageViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class VoucherspageController extends Controller
{
    private $voucherspage;

    public function __construct()
    {
        // $this->middleware('permission:voucherspage_us.view_all', ['only' => ['index']]);
        // $this->middleware('permission:voucherspage_us.view_details', ['only' => ['show']]);
        // $this->middleware('permission:voucherspage_us.create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:voucherspage_us.edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:voucherspage_us.delete', ['only' => ['destroy']]);
      
        $this->middleware(['auth:admin', 'permission:voucherspage.view_all'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:voucherspage.view_details'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:voucherspage.create'],['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:voucherspage.edit'],['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:voucherspage.delete'], ['only' => ['destroy']]);
        $this->voucherspage = new VoucherspageService();
    }

    /**
     * Display a listing of the voucherspage.
     */
    public function index(Request $request): View
    {
        // dd($request->all());
        return view('admin.pages.voucherspage.index');
    }

    public function table(DataTables $dataTables, Request $request)
    {
        $model = Voucherspage::with(['client', 'offer', 'product', 'coupon'])->ordered();

        return $dataTables->eloquent($model)
            ->addIndexColumn()
            ->editColumn('client_id', function (Voucherspage $voucherspage) {
                return $voucherspage->client->name ?? '-';
            })
            ->editColumn('offer_id', function (Voucherspage $voucherspage) {
                return $voucherspage->offer->name ?? '-';
            })
            ->editColumn('product_id', function (Voucherspage $voucherspage) {
                return $voucherspage->product->name ?? '-';
            })
            ->editColumn('coupon_id', function (Voucherspage $voucherspage) {
                return $voucherspage->coupon->code ?? '-';
            })
            ->editColumn('points', function (Voucherspage $voucherspage) {
                return $voucherspage->points ?? '-';
            })
            ->editColumn('created_at', function (Voucherspage $voucherspage) {
                return $voucherspage->created_at->format('d-m-Y h:i A') ?? '-';
            })
            ->addColumn('action', function (Voucherspage $voucherspage) {
                return view('admin.pages.voucherspage.buttons', compact('voucherspage'));
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    /**
     * Display a Single Row of the resource.
     */
    public function Show($id): View
    {
        $voucherspage = Voucherspage::find($id);
        return view('admin.pages.voucherspage.show', get_defined_vars());
    }

    /**
     * Show the form for creating a new voucherspage.
     */
    public function create(): View
    {
        return view('admin.pages.voucherspage____.form',  new VoucherspageViewModel());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VoucherspageRequest $request)
    {
        // return $request;
        $this->voucherspage->createVoucherspage($request->validated());
        session()->flash('success', TranslationHelper::translate('Operation Success'));
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Voucherspage $voucherspage): View
    {
        return view('admin.pages.voucherspage.___form',  new VoucherspageViewModel($voucherspage));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VoucherspageRequest $request, Voucherspage $voucherspage): RedirectResponse
    {
        //        return $request;
        $this->voucherspage->updateVoucherspage($voucherspage, $request->validated());
        session()->flash('success', TranslationHelper::translate('Successfully Updated'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Voucherspage $voucherspage): JsonResponse
    {
        $this->voucherspage->deleteVoucherspage($voucherspage);
        return response()->json(['status' => 'success', 'message' => TranslationHelper::translate('Successfully Deleted')]);
    }

    public function reorder(Voucherspage $voucherspage)
    {
        return $this->voucherspage->reorder($voucherspage, 'name', 'admin.pages.voucherspage.reorder', 1);
    }

    public function saveReorder(Request $request, Voucherspage $voucherspage)
    {
        $all_entries = $request->input('tree');
        return $this->voucherspage->saveReorder($all_entries, $voucherspage);
    }
}
