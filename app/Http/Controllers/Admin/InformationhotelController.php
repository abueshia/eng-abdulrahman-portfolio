<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Informationhotel\InformationhotelRequest;
use App\Models\Informationhotel;
use App\Services\InformationhotelService;
use App\ViewModels\InformationhotelViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class InformationhotelController extends Controller
{
    private $informationhotel;

    public function __construct()
    {
        // $this->middleware('permission:information_hotels.view_all', ['only' => ['index']]);
        // $this->middleware('permission:information_hotels.view_details', ['only' => ['show']]);
        // $this->middleware('permission:information_hotels.create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:information_hotels.edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:information_hotels.delete', ['only' => ['destroy']]);
        
        $this->middleware(['auth:admin', 'permission:information_hotels.view_all'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:information_hotels.view_details'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:information_hotels.create'], ['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:information_hotels.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:information_hotels.delete'], ['only' => ['destroy']]);
        $this->middleware(['auth:admin', 'permission:information_hotels.sort'], ['only' => ['reorder', 'saveReorder']]);

        $this->informationhotel = new InformationhotelService();
    }

    /**
     * Display a listing of the informationhotel.
     */
    public function index(Request $request): View
    {
        // dd($request->all());
        return view('admin.pages.informationhotel.index');
    }

    // public function table(DataTables $dataTables, Request $request)
    // {
    //     $model = Informationhotel::ordered();

    //     return $dataTables->eloquent($model)->addIndexColumn()
    //         ->editColumn('id', function (Informationhotel $informationhotel) {
    //             return $informationhotel->id ?? '-';
    //         })->editColumn('name', function (Informationhotel $informationhotel) {
    //             return $informationhotel->name;
    //         })->editColumn('name_job', function (Informationhotel $informationhotel) {
    //             return "<img width='100' src=' " . $informationhotel->getFirstMediaUrl('informationhotels') . " '/>";
    //         })->editColumn('created_at', function (Informationhotel $informationhotel) {
    //             return $informationhotel->created_at->format('d-m-Y h:i A') ?? '-';
    //         })->addColumn('action', function (Informationhotel $informationhotel) {
    //             return view('admin.pages.informationhotel.buttons', compact('informationhotel'));
    //         })
    //         ->rawColumns(['image', 'action'])
    //         ->startsWithSearch()
    //         ->make(true);
    // }
    public function table(DataTables $dataTables, Request $request)
    {
        $model = Informationhotel::ordered();

        if ($request->has('search') && !empty($request->search['value'])) {
            $search = $request->search['value'];

            $model = $model->where('name', 'LIKE', '%' . $search . '%');
        }

        return $dataTables->eloquent($model)
            ->addIndexColumn()
            ->editColumn('id', function (Informationhotel $informationhotel) {
                return $informationhotel->id ?? '-';
            })
            ->editColumn('name', function (Informationhotel $informationhotel) {
                return $informationhotel->name ?? '-';
            })
            ->editColumn('name_job', function (Informationhotel $informationhotel) {
                return "<img width='100' src='" . $informationhotel->getFirstMediaUrl('informationhotels') . "' />";
            })
            ->editColumn('created_at', function (Informationhotel $informationhotel) {
                return $informationhotel->created_at ? $informationhotel->created_at->format('d-m-Y h:i A') : '-';
            })
            ->addColumn('action', function (Informationhotel $informationhotel) {
                return view('admin.pages.informationhotel.buttons', compact('informationhotel'));
            })
            ->rawColumns(['name_job', 'action']) 
            ->make(true);
    }


    /**
     * Display a Single Row of the resource.
     */
    public function Show($id): View
    {
        $informationhotel = Informationhotel::find($id);
        return view('admin.pages.informationhotel.show', get_defined_vars());
    }

    /**
     * Show the form for creating a new informationhotel.
     */
    public function create(): View
    {
        return view('admin.pages.informationhotel.form',  new InformationhotelViewModel());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InformationhotelRequest $request)
    {
        // return $request;
        $this->informationhotel->createInformationhotel($request->validated());
        session()->flash('success', TranslationHelper::translate('Operation Success'));
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Informationhotel $informationhotel): View
    {
        return view('admin.pages.informationhotel.form',  new InformationhotelViewModel($informationhotel));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InformationhotelRequest $request, Informationhotel $informationhotel): RedirectResponse
    {
        //        return $request;
        $this->informationhotel->updateInformationhotel($informationhotel, $request->validated());
        session()->flash('success', TranslationHelper::translate('Successfully Updated'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Informationhotel $informationhotel): JsonResponse
    {
        $this->informationhotel->deleteInformationhotel($informationhotel);
        return response()->json(['status' => 'success', 'message' => TranslationHelper::translate('Successfully Deleted')]);
    }

    public function reorder(Informationhotel $informationhotel)
    {
        return $this->informationhotel->reorder($informationhotel, 'name', 'admin.pages.informationhotel.reorder', 1);
    }

    public function saveReorder(Request $request, Informationhotel $informationhotel)
    {
        $all_entries = $request->input('tree');
        return $this->informationhotel->saveReorder($all_entries, $informationhotel);
    }
}
