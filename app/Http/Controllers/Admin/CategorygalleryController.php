<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Categorygallery\CategorygalleryRequest;
use App\Models\Categorygallery;
use App\Models\Gallery;
use App\Models\ServiceSubCategorygallery;
use App\Services\CategorygalleryService;
use App\ViewModels\CategorygalleryViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class CategorygalleryController extends Controller
{
    private $categorygallery;

    public function __construct()
    {
        // $this->middleware('permission:category_gallery.view_all', ['only' => ['index']]);
        // $this->middleware('permission:category_gallery.view_details', ['only' => ['show']]);
        // $this->middleware('permission:category_gallery.create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:category_gallery.edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:category_gallery.delete', ['only' => ['destroy']]);


        $this->middleware(['auth:admin', 'permission:category_gallery.view_all'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:category_gallery.view_details'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:category_gallery.create'], ['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:category_gallery.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:category_gallery.delete'], ['only' => ['destroy']]);
        $this->middleware(['auth:admin', 'permission:category_gallery.sort'], ['only' => ['reorder', 'saveReorder']]);

        

        $this->middleware(['auth:admin', 'permission:category_gallery.sort'], ['only' => ['reorder', 'saveReorder']]);
        $this->categorygallery = new CategorygalleryService();
    }

    /**
     * Display a listing of the categorygallery.
     */
    public function index(Request $request) : View
    {
        return view('admin.pages.categorygallery.index');
    }

    // public function table(DataTables $dataTables, Request $request) {
    //     $model = Categorygallery::ordered();

    //     return $dataTables->eloquent($model)->addIndexColumn()
    //         ->editColumn('id', function (Categorygallery $categorygallery) {
    //             return $categorygallery->id ?? '-';
    //         })->editColumn('name', function (Categorygallery $categorygallery) {
    //             return $categorygallery->name;
    //         })->editColumn('image', function (Categorygallery $categorygallery) {
    //             return "<img width='100' src=' ".$categorygallery->getFirstMediaUrl('categorygalleries')." '/>";
    //         })->editColumn('created_at', function (Categorygallery $categorygallery) {
    //             return $categorygallery->created_at->format('d-m-Y h:i A') ?? '-';
    //         })->addColumn('action', function (Categorygallery $categorygallery) {
    //             return view('admin.pages.categorygallery.buttons', compact('categorygallery'));
    //         })
    //         ->rawColumns(['image','action'])
    //         ->startsWithSearch()
    //         ->make(true);
    // }


    // public function table(DataTables $dataTables, Request $request)
    // {
    //     $model = Categorygallery::ordered();

    //     return $dataTables->eloquent($model)->addIndexColumn()
    //         ->editColumn('id', function (Categorygallery $categorygallery) {
    //             return $categorygallery->id ?? '-';
    //         })
    //         ->editColumn('name', function (Categorygallery $categorygallery) {
    //             return $categorygallery->name;
    //         })
    //         ->editColumn('image', function (Categorygallery $categorygallery) {
    //             return "<img width='100' src='" . $categorygallery->getFirstMediaUrl('categorygalleries') . "' />";
    //         })
    //         ->editColumn('created_at', function (Categorygallery $categorygallery) {
    //             return $categorygallery->created_at->format('d-m-Y h:i A') ?? '-';
    //         })
    //         ->addColumn('action', function (Categorygallery $categorygallery) {
    //             return view('admin.pages.categorygallery.buttons', compact('categorygallery'));
    //         })
    //         ->filterColumn('name', function ($query, $keyword) {
    //             $query->where('name', 'LIKE', "%$keyword%");
    //         })
    //         ->rawColumns(['image', 'action'])
    //         ->startsWithSearch()
    //         ->make(true);
    // }

    public function table(DataTables $dataTables, Request $request)
    {
      
        // استرجاع البيانات من نموذج Categorygallery
        $model = Categorygallery::ordered();

        return $dataTables->eloquent($model)->addIndexColumn()
            ->editColumn('id', function (Categorygallery $categorygallery) {
                return $categorygallery->id ?? '-';
            })
            ->editColumn('name', function (Categorygallery $categorygallery) {
                return $categorygallery->name;
            })
            ->editColumn('image', function (Categorygallery $categorygallery) {
                return "<img width='100' src='" . $categorygallery->getFirstMediaUrl('categorygalleries') . "' />";
            })
            ->editColumn('created_at', function (Categorygallery $categorygallery) {
                return $categorygallery->created_at->format('d-m-Y h:i A') ?? '-';
            })
            ->addColumn('action', function (Categorygallery $categorygallery) {
                return view('admin.pages.categorygallery.buttons', compact('categorygallery'));
            })
            // تفعيل البحث في اسم القسم
            ->filterColumn('name', function ($query, $keyword) {
                $query->where('name', 'LIKE', "%$keyword%");
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
        $categorygallery = Categorygallery::find($id);
        return view('admin.pages.categorygallery.show' , get_defined_vars());
    }

    /**
     * Show the form for creating a new categorygallery.
     */
    public function create() : View
    {
        return view('admin.pages.categorygallery.form' ,  new CategorygalleryViewModel());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategorygalleryRequest $request) : RedirectResponse
    {
        // dd($request->validated());
        $this->categorygallery->createCategorygallery($request->validated());
        session()->flash('success', TranslationHelper::translate('Operation Success'));
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categorygallery $categorygallery) : View
    {
        return view('admin.pages.categorygallery.form' ,  new CategorygalleryViewModel($categorygallery));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(CategorygalleryRequest $request, Categorygallery $categorygallery) : RedirectResponse
    {
//        return $request;
        $this->categorygallery->updateCategorygallery($categorygallery , $request->validated());
        session()->flash('success', TranslationHelper::translate('Successfully Updated'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorygallery $categorygallery) : JsonResponse
    {
        $this->categorygallery->deleteCategorygallery($categorygallery);
        return response()->json(['status' => 'success', 'message' => TranslationHelper::translate('Successfully Deleted')]);

    }

    public function reorder(Categorygallery $categorygallery) {
        return $this->categorygallery->reorder($categorygallery, 'name', 'admin.pages.categorygallery.reorder', 1);
    }

    public function saveReorder(Request $request, Categorygallery $categorygallery) {
        $all_entries = \Request::input('tree');
        return $this->categorygallery->saveReorder($all_entries, $categorygallery);
    }

    public function getSubsFromMain(Request $request) {
        $data = ServiceSubCategorygallery::where('service_categorygallery_id', $request->id)->get();
        return response()->json(['msg' => 'Collection of Subcategories', 'status' => 1, 'data' => $data]);

    }

}
