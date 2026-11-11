<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Productcategory\ProductcategoryRequest;
use App\Models\Productcategory;
use App\Services\ProductcategoryService;
use App\ViewModels\ProductcategoryViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class ProductcategoryController extends Controller
{
    private $productcategory;

    public function __construct()
    {
        // $this->middleware('permission:productcategory_us.view_all', ['only' => ['index']]);
        // $this->middleware('permission:productcategory_us.view_details', ['only' => ['show']]);
        // $this->middleware('permission:productcategory_us.create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:productcategory_us.edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:productcategory_us.delete', ['only' => ['destroy']]);

      
        $this->middleware(['auth:admin', 'permission:productcategory.view_all'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:productcategory.view_details'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:productcategory.create'],['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:productcategory.edit'],['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:productcategory.delete'], ['only' => ['destroy']]);
        $this->productcategory = new ProductcategoryService();
    }

    /**
     * Display a listing of the productcategory.
     */
    public function index(Request $request): View
    {
        // dd($request->all());
        return view('admin.pages.productcategory.index');
    }


    public function table(DataTables $dataTables, Request $request)
    {
        $model = Productcategory::ordered();

        // if ($request->filled('name')) {
        //     $model->where('name', 'LIKE', '%' . $request->name . '%');
        // }

        if ($request->has('search') && $request->search['value'] != '') {
            $name = mb_strtolower($request->search['value'], 'UTF-8');
            $model->whereRaw('LOWER(name) LIKE ?', ['%' . $name . '%']);
        }

        return $dataTables->eloquent($model)->addIndexColumn()
            ->editColumn('id', function (Productcategory $productcategory) {
                return $productcategory->id ?? '-';
            })
            ->editColumn('image', function (Productcategory $product) {
                return "<img width='100' src='" . $product->getFirstMediaUrl('product_category') . "' />";
            })
            ->editColumn('name', function (Productcategory $productcategory) {
                return $productcategory->name;
            })
            ->editColumn('created_at', function (Productcategory $productcategory) {
                return $productcategory->created_at->format('d-m-Y') ?? '-';
            })
            ->addColumn('action', function (Productcategory $productcategory) {
                return view('admin.pages.productcategory.buttons', compact('productcategory'));
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
        $productcategory = Productcategory::find($id);
        return view('admin.pages.productcategory.show', get_defined_vars());
    }

    /**
     * Show the form for creating a new productcategory.
     */
    public function create(): View
    {
        return view('admin.pages.productcategory.form',  new ProductcategoryViewModel());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductcategoryRequest $request)
    {
        // return $request;
        $this->productcategory->createProductcategory($request->validated());
        session()->flash('success', TranslationHelper::translate('Operation Success'));
        return back();
    }
    public function storeAjax(Request $request)
    {
        if($request->has('name') && $request->name != '') {
            // Save Productcategory Name
            $new_productcategory = Productcategory::create([
                'name' => $request->name
            ]);
            return response()->json(['status' => 1, 'msg' => TranslationHelper::translate('Operation Success'), 'data' => $new_productcategory ]);
        } else {
            return response()->json(['status' => 0, 'msg' => TranslationHelper::translate('Operation Failed'), 'data' => null]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Productcategory $productcategory): View
    {
        return view('admin.pages.productcategory.form',  new ProductcategoryViewModel($productcategory));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductcategoryRequest $request, Productcategory $productcategory): RedirectResponse
    {
        //        return $request;
        $this->productcategory->updateProductcategory($productcategory, $request->validated());
        session()->flash('success', TranslationHelper::translate('Successfully Updated'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Productcategory $productcategory): JsonResponse
    {
        $this->productcategory->deleteProductcategory($productcategory);
        return response()->json(['status' => 'success', 'message' => TranslationHelper::translate('Successfully Deleted')]);
    }

    public function reorder(Productcategory $productcategory)
    {
        return $this->productcategory->reorder($productcategory, 'name', 'admin.pages.productcategory.reorder', 1);
    }

    public function saveReorder(Request $request, Productcategory $productcategory)
    {
        $all_entries = $request->input('tree');
        return $this->productcategory->saveReorder($all_entries, $productcategory);
    }
}
