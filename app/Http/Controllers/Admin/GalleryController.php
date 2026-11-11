<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Gallery\GalleryRequest;
use App\Models\Gallery;
use App\Models\Category;
use App\Models\Tag;
use App\Services\GalleryService;
use App\ViewModels\GalleryViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class GalleryController extends Controller
{
    private $gallery;

    public function __construct()
    {
        // $this->middleware('permission:gallery.view_all', ['only' => ['index']]);
        // $this->middleware('permission:gallery.view_details', ['only' => ['show']]);
        // $this->middleware('permission:gallery.create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:gallery.edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:gallery.delete', ['only' => ['destroy']]);


         $this->middleware(['auth:admin', 'permission:gallery.view_all'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:gallery.view_details'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:gallery.create'], ['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:gallery.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:gallery.delete'], ['only' => ['destroy']]);
        $this->middleware(['auth:admin', 'permission:gallery.sort'], ['only' => ['reorder', 'saveReorder']]);
        $this->gallery = new GalleryService();
    }

    /**
     * Display a listing of the gallery.
     */
    public function index(Request $request): View
    {
        return view('admin.pages.gallery.index');
    }

    public function table(DataTables $dataTables, Request $request)
    {
        $model = Gallery::with('Categorygallery')->ordered();

        return $dataTables->eloquent($model)->addIndexColumn()
            ->editColumn('id', function (Gallery $gallery) {
                return $gallery->id ?? '-';
            })
            // ->editColumn('name', function (Gallery $gallery) {
            //     return $gallery->name;
            // })
            ->editColumn('category', function (Gallery $gallery) {
                return $gallery->categorygallery->name ?? '-'; // اسم القسم
            })
            ->editColumn('image', function (Gallery $gallery) {
                return "<img width='100' src='" . $gallery->getFirstMediaUrl('galleries_image') . "' />";
            })
            ->editColumn('created_at', function (Gallery $gallery) {
                return $gallery->created_at->format('d-m-Y h:i A') ?? '-';
            })
            ->addColumn('action', function (Gallery $gallery) {
                return view('admin.pages.gallery.buttons', compact('gallery'));
            })
            // إضافة خاصية البحث في اسم القسم
            ->filterColumn('category', function ($query, $keyword) {
                $query->whereHas('Categorygallery', function ($q) use ($keyword) {
                    $q->where('name', 'LIKE', "%$keyword%");
                });
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

        $gallery = Gallery::with('Categorygallery')->find($id);
        return view('admin.pages.gallery.show', get_defined_vars());
    }

    /**
     * Show the form for creating a new gallery.
     */
    public function create(): View
    {
        return view('admin.pages.gallery.form',  new GalleryViewModel(), get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GalleryRequest $request)
    {
        // return $request;
        $this->gallery->createGallery($request->validated());
        session()->flash('success', TranslationHelper::translate('Operation Success'));
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery): View
    {
        $tags = Tag::get();

        return view('admin.pages.gallery.form',  new GalleryViewModel($gallery), get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GalleryRequest $request, Gallery $gallery): RedirectResponse
    {
        //        return $request;
        $this->gallery->updateGallery($gallery, $request->validated());
        session()->flash('success', TranslationHelper::translate('Successfully Updated'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery): JsonResponse
    {
        $this->gallery->deleteGallery($gallery);
        return response()->json(['status' => 'success', 'message' => TranslationHelper::translate('Successfully Deleted')]);
    }

    public function reorder(Gallery $gallery)
    {
        return $this->gallery->reorder($gallery, 'name', 'admin.pages.gallery.reorder', 1);
    }

    public function saveReorder(Request $request, Gallery $gallery)
    {
        $all_entries = $request->input('tree');
        return $this->gallery->saveReorder($all_entries, $gallery);
    }

}
