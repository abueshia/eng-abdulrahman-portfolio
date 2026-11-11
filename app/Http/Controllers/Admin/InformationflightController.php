<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Informationflight\InformationflightRequest;
use App\Models\Informationflight;
use App\Services\InformationflightService;
use App\ViewModels\InformationflightViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class InformationflightController extends Controller
{
    private $informationflight;

    public function __construct()
    {

        $this->middleware(['auth:admin', 'permission:information_flights.view_all'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:information_flights.view_details'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:information_flights.create'], ['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:information_flights.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:information_flights.delete'], ['only' => ['destroy']]);
        $this->middleware(['auth:admin', 'permission:information_flights.sort'], ['only' => ['reorder', 'saveReorder']]);


        $this->informationflight = new InformationflightService();
    }

    /**
     * Display a listing of the informationflight.
     */
    public function index(Request $request): View
    {
        // dd($request->all());
        return view('admin.pages.informationflight.index');
    }


    public function table(DataTables $dataTables, Request $request)
    {
        $model = Informationflight::ordered();

        // إذا كان هناك قيمة بحث تم إرسالها
        if ($request->has('search') && !empty($request->search['value'])) {
            $search = $request->search['value'];

            $model = $model->where('name', 'LIKE', '%' . $search . '%');
        }

        return $dataTables->eloquent($model)
            ->addIndexColumn()
            ->editColumn('id', function (Informationflight $informationflight) {
                return $informationflight->id ?? '-';
            })
            ->editColumn('name', function (Informationflight $informationflight) {
                return $informationflight->name ?? '-';
            })
            ->editColumn('name_job', function (Informationflight $informationflight) {
                return "<img width='100' src='" . $informationflight->getFirstMediaUrl('informationflights') . "' />";
            })
            ->editColumn('created_at', function (Informationflight $informationflight) {
                return $informationflight->created_at ? $informationflight->created_at->format('d-m-Y h:i A') : '-';
            })
            ->addColumn('action', function (Informationflight $informationflight) {
                return view('admin.pages.informationflight.buttons', compact('informationflight'));
            })
            ->rawColumns(['name_job', 'action']) 
            ->make(true);
    }


    /**
     * Display a Single Row of the resource.
     */
    public function Show($id): View
    {
        $informationflight = Informationflight::find($id);
        return view('admin.pages.informationflight.show', get_defined_vars());
    }

    /**
     * Show the form for creating a new informationflight.
     */
    public function create(): View
    {
        return view('admin.pages.informationflight.form',  new InformationflightViewModel());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InformationflightRequest $request)
    {
        // return $request;
        $this->informationflight->createInformationflight($request->validated());
        session()->flash('success', TranslationHelper::translate('Operation Success'));
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Informationflight $informationflight): View
    {
        return view('admin.pages.informationflight.form',  new InformationflightViewModel($informationflight));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InformationflightRequest $request, Informationflight $informationflight): RedirectResponse
    {
        //        return $request;
        $this->informationflight->updateInformationflight($informationflight, $request->validated());
        session()->flash('success', TranslationHelper::translate('Successfully Updated'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Informationflight $informationflight): JsonResponse
    {
        $this->informationflight->deleteInformationflight($informationflight);
        return response()->json(['status' => 'success', 'message' => TranslationHelper::translate('Successfully Deleted')]);
    }

    public function reorder(Informationflight $informationflight)
    {
        return $this->informationflight->reorder($informationflight, 'name', 'admin.pages.informationflight.reorder', 1);
    }

    public function saveReorder(Request $request, Informationflight $informationflight)
    {
        $all_entries = $request->input('tree');
        return $this->informationflight->saveReorder($all_entries, $informationflight);
    }
}
