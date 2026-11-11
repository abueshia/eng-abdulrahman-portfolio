<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Informationtour\InformationtourRequest;
use App\Models\Informationtour;
use App\Services\InformationtourService;
use App\ViewModels\InformationtourViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class InformationtourController extends Controller
{
    private $informationtour;

    public function __construct()
    {

        // $this->middleware('permission:information_tours.view_all', ['only' => ['index']]);
        // $this->middleware('permission:information_tours.view_details', ['only' => ['show']]);
        // $this->middleware('permission:information_tours.create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:information_tours.edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:information_tours.delete', ['only' => ['destroy']]);


        $this->middleware(['auth:admin', 'permission:information_tours.view_all'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:information_tours.view_details'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:information_tours.create'], ['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:information_tours.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:information_tours.delete'], ['only' => ['destroy']]);
        $this->middleware(['auth:admin', 'permission:information_tours.sort'], ['only' => ['reorder', 'saveReorder']]);

        $this->informationtour = new InformationtourService();
    }

    /**
     * Display a listing of the informationtour.
     */
    public function index(Request $request): View
    {
        // dd($request->all());
        return view('admin.pages.informationtour.index');
    }

public function table(DataTables $dataTables, Request $request)
{
    $model = Informationtour::ordered();

    // إذا كان هناك طلب بحث عام على اسم الـ Informationtour
    if ($request->has('search') && !empty($request->search['value'])) {
        $search = $request->search['value'];

        // البحث في حقل name فقط
        $model = $model->where('name', 'LIKE', '%' . $search . '%');
    }

    return $dataTables->eloquent($model)
        ->addIndexColumn()
        ->editColumn('id', function (Informationtour $informationtour) {
            return $informationtour->id ?? '-';
        })
        ->editColumn('name', function (Informationtour $informationtour) {
            return $informationtour->name ?? '-';
        })
        ->editColumn('name_job', function (Informationtour $informationtour) {
            return "<img width='100' src='" . $informationtour->getFirstMediaUrl('informationtours') . "' />";
        })
        ->editColumn('created_at', function (Informationtour $informationtour) {
            return $informationtour->created_at ? $informationtour->created_at->format('d-m-Y h:i A') : '-';
        })
        ->addColumn('action', function (Informationtour $informationtour) {
            return view('admin.pages.informationtour.buttons', compact('informationtour'));
        })
        ->rawColumns(['name_job', 'action']) // تأكد من إضافة الحقول التي تحتوي على HTML داخلها
        ->make(true);
}


    /**
     * Display a Single Row of the resource.
     */
    public function Show($id): View
    {
        $informationtour = Informationtour::find($id);
        return view('admin.pages.informationtour.show', get_defined_vars());
    }

    /**
     * Show the form for creating a new informationtour.
     */
    public function create(): View
    {
        return view('admin.pages.informationtour.form',  new InformationtourViewModel());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InformationtourRequest $request)
    {
        // return $request;
        $this->informationtour->createInformationtour($request->validated());
        session()->flash('success', TranslationHelper::translate('Operation Success'));
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Informationtour $informationtour): View
    {
        return view('admin.pages.informationtour.form',  new InformationtourViewModel($informationtour));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InformationtourRequest $request, Informationtour $informationtour): RedirectResponse
    {
        //        return $request;
        $this->informationtour->updateInformationtour($informationtour, $request->validated());
        session()->flash('success', TranslationHelper::translate('Successfully Updated'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Informationtour $informationtour): JsonResponse
    {
        $this->informationtour->deleteInformationtour($informationtour);
        return response()->json(['status' => 'success', 'message' => TranslationHelper::translate('Successfully Deleted')]);
    }

    public function reorder(Informationtour $informationtour)
    {
        return $this->informationtour->reorder($informationtour, 'name', 'admin.pages.informationtour.reorder', 1);
    }

    public function saveReorder(Request $request, Informationtour $informationtour)
    {
        $all_entries = $request->input('tree');
        return $this->informationtour->saveReorder($all_entries, $informationtour);
    }
}
