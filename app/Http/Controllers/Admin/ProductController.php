<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\ProductRequest;
use App\Models\Product;
use App\Models\Productcategory;
use App\Services\ProductService;
use App\ViewModels\ProductcategoryViewModel;
use App\ViewModels\ProductViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    private $product;

    public function __construct()
    {
        // $this->middleware('permission:product.view_all', ['only' => ['index']]);
        // $this->middleware('permission:product.view_details', ['only' => ['show']]);
        // $this->middleware('permission:product.create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:product.edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:product.delete', ['only' => ['destroy']]);

        $this->middleware(['auth:admin', 'permission:product.view_all'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:product.view_details'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:product.create'], ['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:product.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:product.delete'], ['only' => ['destroy']]);
         $this->middleware(['auth:admin', 'permission:product.sort'], ['only' => [
            'reorder',
            'saveReorder'
        ]]);
        $this->product = new ProductService();
    }

    /**
     * Display a listing of the product.
     */
    public function index(Request $request): View
    {
        // dd($request->all());
        return view('admin.pages.product.index');
    }

    public function table(DataTables $dataTables, Request $request)
    {
        $model = Product::query();

        // if ($request->has('search') && !empty($request->search['value'])) {
        //     $search = $request->search['value'];

        //     $model = $model->where('name', 'LIKE', '%' . $search . '%');
        // }
        if ($request->has('search') && !empty($request->search['value'])) {
            $search = $request->search['value'];

            // البحث في حقل الاسم فقط باستخدام LOWER لتجاهل حالة الحروف
            $model = $model->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%']);
        }

        return $dataTables->eloquent($model)
            ->addIndexColumn()
            ->editColumn('id', function (Product $product) {
                return $product->id ?? '-';
            })

            ->editColumn('image', function (Product $product) {
                return "<img width='100' src='" . $product->getFirstMediaUrl('products') . "' />";
            })

            ->editColumn('name', function (Product $product) {
                return $product->name ?? '-';
            })

            ->editColumn('created_at', function (Product $product) {
                return $product->created_at ? $product->created_at->format('d-m-Y') : '-';
            })

            ->addColumn('action', function (Product $product) {
                return view('admin.pages.product.buttons', compact('product'));
            })
            
            ->rawColumns(['image', 'action'])  // تأكد من إضافة 'image' في rawColumns
            ->make(true);
    }

    /**
     * Display a Single Row of the resource.
     */
    public function Show($id): View
    {
        $product = Product::find($id);
        return view('admin.pages.product.show', get_defined_vars());
    }

    /**
     * Show the form for creating a new product.
     */
    public function create(): View
    {
        $productcategories = Productcategory::get();
        return view('admin.pages.product.form',  new ProductViewModel(), get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        // return $request;
        $this->product->createProduct($request->validated());
        session()->flash('success', TranslationHelper::translate('Operation Success'));
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        // dd($product);
        $productcategories = Productcategory::get();
        return view('admin.pages.product.form',  new ProductViewModel($product), get_defined_vars());
    }

   
    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        //        return $request;
        $this->product->updateProduct($product, $request->validated());
        session()->flash('success', TranslationHelper::translate('Successfully Updated'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): JsonResponse
    {
        $this->product->deleteProduct($product);
        return response()->json(['status' => 'success', 'message' => TranslationHelper::translate('Successfully Deleted')]);
    }

    // public function deleteMedia($id)
    // {
    //     $media = Media::findOrFail($id);
    //     $media->delete();
    //     return back()->with('success', 'Image deleted successfully!');
    // }
    public function deleteMedia($id)
    {
        try {
            $media = Media::findOrFail($id); 
            $media->delete(); 

            return response()->json([
                'success' => true,
                'message' => 'Image deleted successfully!'
            ], 200); 
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete the image. Please try again.',
                'error' => $e->getMessage() 
            ], 500); 
        }
    }


    public function reorder(Product $product)
    {
        return $this->product->reorder($product, 'name', 'admin.pages.product.reorder', 1);
    }

    public function saveReorder(Request $request, Product $product)
    {
        $all_entries = $request->input('tree');
        return $this->product->saveReorder($all_entries, $product);
    }
}
