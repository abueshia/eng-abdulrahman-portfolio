<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Categorycolid\CategorycolidRequest;
use App\Models\Category;
use App\Models\Categorycolid;
use App\Models\ServiceSubCategorycolid;
use App\Services\CategorycolidService;
use App\ViewModels\CategorycolidViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class CategorycolidController extends Controller
{
    private $categorycolid;

    public function __construct()
    {

        $this->middleware(['auth:admin', 'permission:categorycolid.view_all'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:categorycolid.view_details'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:categorycolid.create'], ['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:categorycolid.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:categorycolid.delete'], ['only' => ['destroy']]);
        $this->middleware(['auth:admin', 'permission:categorycolid.sort'], ['only' => ['reorder', 'saveReorder']]);

        $this->categorycolid = new CategorycolidService();
    }

    /**
     * Display a listing of the categorycolid.
     */
    public function index(Request $request) : View
    {
        return view('admin.pages.categorycolid.index');
    }

    public function table(DataTables $dataTables, Request $request)
    {
        $model = Categorycolid::query();
        
        return $dataTables->eloquent($model)
            ->addIndexColumn()
            ->editColumn('id', function (Categorycolid $categorycolid) {
                return $categorycolid->id ?? '-';
            })
            ->editColumn('name', function (Categorycolid $categorycolid) {
                return $categorycolid->name;
            })
            ->editColumn('category', function (Categorycolid $categorycolid) {
                return $categorycolid->categories->name ?? '-';
            })
            ->editColumn('created_at', function (Categorycolid $categorycolid) {
                return $categorycolid->created_at->format('d-m-Y h:i A') ?? '-';
            })
            ->addColumn('action', function (Categorycolid $categorycolid) {
                return view('admin.pages.categorycolid.buttons', compact('categorycolid'));
            })
            ->rawColumns(['image', 'action'])
            ->startsWithSearch()
            ->make(true);
    }
    
    // public function table(DataTables $dataTables, Request $request)
    // {
    //     $model = Categorycolid::ordered();
    //     // dd($model);

    //     return $dataTables->eloquent($model)->addIndexColumn()
    //         ->editColumn('id', function (Categorycolid $categorycolid) {
    //             return $categorycolid->id ?? '-';
    //         })
    //         ->editColumn('name', function (Categorycolid $categorycolid) {
    //             return $categorycolid->name ?? '-';
    //         })
        
    //         ->editColumn('category', function (Categorycolid $categorycolid) {
    //             return $categorycolid->categories->name ?? '-';
    //         })
     
    //         ->editColumn('created_at', function (Categorycolid $categorycolid) {
    //             return $categorycolid->created_at ? $categorycolid->created_at->format('d-m-Y') : '-';
    //         })
    //         ->addColumn('action', function (Categorycolid $categorycolid) {
    //             return view('admin.pages.categorycolid.buttons', compact('categorycolid'));
    //         })
    //         ->rawColumns(['image', 'action'])
    //         ->startsWithSearch()
    //         ->make(true);
    // }



    /**
     * Display a Single Row of the resource.
     */
    public function Show($id): View
    {
        $categorycolid = Categorycolid::find($id);
        return view('admin.pages.categorycolid.show' , get_defined_vars());
    }

    /**
     * Show the form for creating a new categorycolid.
     */
    public function create() : View
    {
        $categories = Category::all();
        return view('admin.pages.categorycolid.form' ,  new CategorycolidViewModel(), get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategorycolidRequest $request) : RedirectResponse
    {
        $this->categorycolid->createCategorycolid($request->validated());
        session()->flash('success', TranslationHelper::translate('Operation Success'));
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categorycolid $categorycolid) : View
    {
        $categories = Category::all();
        return view('admin.pages.categorycolid.form' ,  new CategorycolidViewModel(), get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategorycolidRequest $request, Categorycolid $categorycolid) : RedirectResponse
    {
//        return $request;
        $this->categorycolid->updateCategorycolid($categorycolid , $request->validated());
        session()->flash('success', TranslationHelper::translate('Successfully Updated'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorycolid $categorycolid) : JsonResponse
    {
        $this->categorycolid->deleteCategorycolid($categorycolid);
        return response()->json(['status' => 'success', 'message' => TranslationHelper::translate('Successfully Deleted')]);
    }

    public function reorder(Categorycolid $categorycolid) {
        return $this->categorycolid->reorder($categorycolid, 'name', 'admin.pages.categorycolid.reorder', 1);
    }

    
    // public function saveReorder(Request $request, Categorycolid $categorycolid) {
    //     $all_entries = \Request::input('tree');
    //     return $this->categorycolid->saveReorder($all_entries, $categorycolid);
    // }

    // public function getSubsFromMain(Request $request) {
    //     $data = ServiceSubCategorycolid::where('service_categorycolid_id', $request->id)->get();
    //     return response()->json(['msg' => 'Collection of Subcategories', 'status' => 1, 'data' => $data]);
    // }

}
