<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\CategoryRequest;
use App\Models\Category;
use App\Models\ServiceSubCategory;
use App\Services\CategoryService;
use App\ViewModels\CategoryViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    private $category;

    public function __construct()
    {
        // $this->middleware('permission:blog_categories.view_all', ['only' => ['index']]);
        // $this->middleware('permission:blog_categories.view_details', ['only' => ['show']]);
        // $this->middleware('permission:blog_categories.create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:blog_categories.edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:blog_categories.delete', ['only' => ['destroy']]);


        $this->middleware(['auth:admin', 'permission:blog_categories.view_all'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:blog_categories.view_details'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:blog_categories.create'], ['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:blog_categories.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:blog_categories.delete'], ['only' => ['destroy']]);
        $this->middleware(['auth:admin', 'permission:blog_categories.sort'], ['only' => ['reorder', 'saveReorder']]);

        $this->category = new CategoryService();
    }

    /**
     * Display a listing of the category.
     */
    public function index(Request $request) : View
    {
        return view('admin.pages.category.index');
    }

    public function table(DataTables $dataTables, Request $request) {
        $model = Category::ordered();

        return $dataTables->eloquent($model)->addIndexColumn()
            ->editColumn('id', function (Category $category) {
                return $category->id ?? '-';
            })->editColumn('name', function (Category $category) {
                return $category->name;
            })->editColumn('image', function (Category $category) {
                return "<img width='100' src=' ".$category->getFirstMediaUrl('categories')." '/>";
            })->editColumn('created_at', function (Category $category) {
                return $category->created_at->format('d-m-Y h:i A') ?? '-';
            })->addColumn('action', function (Category $category) {
                return view('admin.pages.category.buttons', compact('category'));
            })
            ->rawColumns(['image','action'])
            ->startsWithSearch()
            ->make(true);
    }

    /**
     * Display a Single Row of the resource.
     */
    public function Show($id): View
    {
        $category = Category::find($id);
        return view('admin.pages.category.show' , get_defined_vars());
    }

    /**
     * Show the form for creating a new category.
     */
    public function create() : View
    {
        return view('admin.pages.category.form' ,  new CategoryViewModel());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request) : RedirectResponse
    {
        $this->category->createCategory($request->validated());
        session()->flash('success', TranslationHelper::translate('Operation Success'));
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category) : View
    {
        return view('admin.pages.category.form' ,  new CategoryViewModel($category));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category) : RedirectResponse
    {
//        return $request;
        $this->category->updateCategory($category , $request->validated());
        session()->flash('success', TranslationHelper::translate('Successfully Updated'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category) : JsonResponse
    {
        $this->category->deleteCategory($category);
        return response()->json(['status' => 'success', 'message' => TranslationHelper::translate('Successfully Deleted')]);
    }

    public function reorder(Category $category) {
        return $this->category->reorder($category, 'name', 'admin.pages.category.reorder', 1);
    }

    
    public function saveReorder(Request $request, Category $category) {
        $all_entries = \Request::input('tree');
        return $this->category->saveReorder($all_entries, $category);
    }

    public function getSubsFromMain(Request $request) {
        $data = ServiceSubCategory::where('service_category_id', $request->id)->get();
        return response()->json(['msg' => 'Collection of Subcategories', 'status' => 1, 'data' => $data]);
    }

}
