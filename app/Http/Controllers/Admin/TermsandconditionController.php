<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str; 
use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Termsandcondition\TermsandconditionnowRequest;
use App\Http\Requests\Admin\Termsandcondition\TermsandconditionRequest;
use App\Models\Termsandcondition;
use App\Services\TermsandconditionService;
use App\ViewModels\TermsandconditionViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class TermsandconditionController extends Controller
{
    private $termsandcondition;

    public function __construct()
    {
        // $this->middleware('permission:termsandcondition.view_all', ['only' => ['index']]);
        // $this->middleware('permission:termsandcondition.view_details', ['only' => ['show']]);
        // $this->middleware('permission:termsandcondition.create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:termsandcondition.edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:termsandcondition.delete', ['only' => ['destroy']]);

        $this->middleware(['auth:admin', 'permission:termsandcondition.view_all'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:termsandcondition.view_details'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:termsandcondition.create'], ['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:termsandcondition.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:termsandcondition.delete'], ['only' => ['destroy']]);
        $this->middleware(['auth:admin', 'permission:termsandcondition.sort'], ['only' => [
            'reorder',
            'saveReorder'
        ]]);
        $this->termsandcondition = new TermsandconditionService();
    }

    /**
     * Display a listing of the termsandcondition.
     */
    public function index(Request $request): View
    {
        // dd($request->all());
        return view('admin.pages.termsandcondition.index');
    }

    // public function table(DataTables $dataTables, Request $request)
    // {
    //     $model = Termsandcondition::ordered();

    //     return $dataTables->eloquent($model)->addIndexColumn()
    //         ->editColumn('id', function (Termsandcondition $termsandcondition) {
    //             return $termsandcondition->id ?? '-';
    //         })->editColumn('name', function (Termsandcondition $termsandcondition) {
    //             return $termsandcondition->name;
    //         })->editColumn('name_job', function (Termsandcondition $termsandcondition) {
    //             return "<img width='100' src=' " . $termsandcondition->getFirstMediaUrl('termsandconditions') . " '/>";
    //         })->editColumn('created_at', function (Termsandcondition $termsandcondition) {
    //             return $termsandcondition->created_at->format('d-m-Y h:i A') ?? '-';
    //         })->addColumn('action', function (Termsandcondition $termsandcondition) {
    //             return view('admin.pages.termsandcondition.buttons', compact('termsandcondition'));
    //         })
    //         ->rawColumns(['image', 'action'])
    //         ->startsWithSearch()
    //         ->make(true);
    // }
    public function table(DataTables $dataTables, Request $request)
    {
        $model = Termsandcondition::query();
        // إذا كان هناك طلب بحث عام
        if ($request->has('search') && !empty($request->search['value'])) {
            $search = $request->search['value'];
            // البحث في حقل الاسم فقط
            $model = $model->where('name', 'LIKE', '%' . $search . '%');
        }

        // إرجاع البيانات بصيغة JSON لجدول DataTables
        return $dataTables->eloquent($model)

            ->addIndexColumn()
            ->editColumn('id', function (Termsandcondition $termsandcondition) {
                return $termsandcondition->id ?? '-';
            })

            ->editColumn('description', function (Termsandcondition $termsandcondition) {
                // اختصار الوصف إلى 150 حرفًا إذا كان موجودًا
                return $termsandcondition->description
                    ? Str::limit(strip_tags($termsandcondition->description), 100, '...')
                    : '-';
            })

            ->editColumn('created_at', function (Termsandcondition $termsandcondition) {
                return $termsandcondition->created_at
                    ? $termsandcondition->created_at->format('d-m-Y')
                    : '-';
            })
            ->addColumn('action', function (Termsandcondition $termsandcondition) {
                return view('admin.pages.termsandcondition.buttons', compact('termsandcondition'));
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    /**
     * Display a Single Row of the resource.
     */
    public function Show($id): View
    {
        $termsandcondition = Termsandcondition::find($id);
        return view('admin.pages.termsandcondition.show', get_defined_vars());
    }
    /**
     * Show the form for creating a new termsandcondition.
     */
    public function create(): View
    { 
        
        return view('admin.pages.termsandcondition.form',  new TermsandconditionViewModel());
    }
     
    /**
     * Store a newly created resource in storage.
     */
    public function store(TermsandconditionnowRequest $request)
    {
        // return $request;
        $this->termsandcondition->createTermsandcondition($request->validated());
        session()->flash('success', TranslationHelper::translate('Operation Success'));
        return back();
    }

    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Termsandcondition $termsandcondition): View
    {
        return view('admin.pages.termsandcondition.form',  new TermsandconditionViewModel($termsandcondition));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TermsandconditionnowRequest $request, Termsandcondition $termsandcondition): RedirectResponse
    {
        
        //return $request;
        $this->termsandcondition->updateTermsandcondition($termsandcondition, $request->validated());
        session()->flash('success', TranslationHelper::translate('Successfully Updated'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Termsandcondition $termsandcondition): JsonResponse
    {
        $this->termsandcondition->deleteTermsandcondition($termsandcondition);
        return response()->json(['status' => 'success', 'message' => TranslationHelper::translate('Successfully Deleted')]);
    }

    public function reorder(Termsandcondition $termsandcondition)
    {
        return $this->termsandcondition->reorder($termsandcondition, 'name', 'admin.pages.termsandcondition.reorder', 1);
    }

    public function saveReorder(Request $request, Termsandcondition $termsandcondition)
    {
        $all_entries = $request->input('tree');
        return $this->termsandcondition->saveReorder($all_entries, $termsandcondition);
    }
}
