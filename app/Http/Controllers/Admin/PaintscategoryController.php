<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Paintscategory\PaintscategoryRequest;
use App\Models\Paintscategory;
use App\Services\PaintscategoryService;
use App\ViewModels\PaintscategoryViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class PaintscategoryController extends Controller
{
    private $paintscategory;

    public function __construct()
    {
        // $this->middleware('permission:paintscategory_us.view_all', ['only' => ['index']]);
        // $this->middleware('permission:paintscategory_us.view_details', ['only' => ['show']]);
        // $this->middleware('permission:paintscategory_us.create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:paintscategory_us.edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:paintscategory_us.delete', ['only' => ['destroy']]);

      
        $this->middleware(['auth:admin', 'permission:paintscategory.view_all'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:paintscategory.view_details'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:paintscategory.create'],['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:paintscategory.edit'],['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:paintscategory.delete'], ['only' => ['destroy']]);
        $this->paintscategory = new PaintscategoryService();
    }

    /**
     * Display a listing of the paintscategory.
     */
    public function index(Request $request): View
    {
        // dd($request->all());
        return view('admin.pages.paintscategory.index');
    }


    public function table(DataTables $dataTables, Request $request)
    {
        $model = Paintscategory::ordered();

        // if ($request->filled('name')) {
        //     $model->where('name', 'LIKE', '%' . $request->name . '%');
        // }

        if ($request->has('search') && $request->search['value'] != '') {
            $name = mb_strtolower($request->search['value'], 'UTF-8');
            $model->whereRaw('LOWER(name) LIKE ?', ['%' . $name . '%']);
        }

        return $dataTables->eloquent($model)->addIndexColumn()
            ->editColumn('id', function (Paintscategory $paintscategory) {
                return $paintscategory->id ?? '-';
            })
            ->editColumn('image', function (Paintscategory $product) {
                return "<img width='100' src='" . $product->getFirstMediaUrl('paints_category') . "' />";
            })
            ->editColumn('name', function (Paintscategory $paintscategory) {
                return $paintscategory->name;
            })
            ->editColumn('created_at', function (Paintscategory $paintscategory) {
                return $paintscategory->created_at->format('d-m-Y') ?? '-';
            })
            ->addColumn('action', function (Paintscategory $paintscategory) {
                return view('admin.pages.paintscategory.buttons', compact('paintscategory'));
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
        $paintscategory = Paintscategory::find($id);
        return view('admin.pages.paintscategory.show', get_defined_vars());
    }

    /**
     * Show the form for creating a new paintscategory.
     */
    public function create(): View
    {
       
        return view('admin.pages.paintscategory.form',  new PaintscategoryViewModel());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaintscategoryRequest $request)
    {
        // return $request;
        $this->paintscategory->createPaintscategory($request->validated());
        session()->flash('success', TranslationHelper::translate('Operation Success'));
        return back();
    }
    public function storeAjax(Request $request)
    {
        if($request->has('name') && $request->name != '') {
            // Save Paintscategory Name
            $new_paintscategory = Paintscategory::create([
                'name' => $request->name
            ]);
            return response()->json(['status' => 1, 'msg' => TranslationHelper::translate('Operation Success'), 'data' => $new_paintscategory ]);
        } else {
            return response()->json(['status' => 0, 'msg' => TranslationHelper::translate('Operation Failed'), 'data' => null]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paintscategory $paintscategory): View
    {
        return view('admin.pages.paintscategory.form',  new PaintscategoryViewModel($paintscategory));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PaintscategoryRequest $request, Paintscategory $paintscategory): RedirectResponse
    {
        //        return $request;
        $this->paintscategory->updatePaintscategory($paintscategory, $request->validated());
        session()->flash('success', TranslationHelper::translate('Successfully Updated'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paintscategory $paintscategory): JsonResponse
    {
        $this->paintscategory->deletePaintscategory($paintscategory);
        return response()->json(['status' => 'success', 'message' => TranslationHelper::translate('Successfully Deleted')]);
    }

    public function reorder(Paintscategory $paintscategory)
    {
        return $this->paintscategory->reorder($paintscategory, 'name', 'admin.pages.paintscategory.reorder', 1);
    }

    public function saveReorder(Request $request, Paintscategory $paintscategory)
    {
        $all_entries = $request->input('tree');
        return $this->paintscategory->saveReorder($all_entries, $paintscategory);
    }
}
