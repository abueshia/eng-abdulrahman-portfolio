<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Affgallery\AffgalleryRequest;
use App\Models\Affgallery;
use App\Models\Gallery;
use App\Services\AffgalleryService;
use App\ViewModels\AffgalleryViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class AffgalleryController extends Controller
{
    private $affgallery;

    public function __construct()
    {
        $this->affgallery = new AffgalleryService();
    }

    /**
     * Display a listing of the affAffgallery.
     */
    public function index(Request $request, $gallery_id): View
    {
        return view('admin.pages.affgallery.index', get_defined_vars());
    }

    public function table(DataTables $dataTables, Request $request, $gallery_id)
    {
        $model = Affgallery::ordered();

        return $dataTables->eloquent($model)->addIndexColumn()
            ->editColumn('id', function (affgallery $affgallery) {
                return $affgallery->id ?? '-';
            })->editColumn('name', function (affgallery $affgallery) {
                return $affgallery->name;
            })->editColumn('image', function (Affgallery $affgallery) {
                return "<img width='100' src=' " . $affgallery->getFirstMediaUrl('aff_galleries') . " '/>";
            })->editColumn('created_at', function (Affgallery $affgallery) {
                return $affgallery->created_at->format('d-m-Y h:i A') ?? '-';
            })->addColumn('action', function (Affgallery $affgallery) use ($gallery_id) {
                return view('admin.pages.affgallery.buttons', compact('affgallery', 'gallery_id'));
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
        $affgallery = Affgallery::find($id);
        return view('admin.pages.affgallery.show', get_defined_vars());
    }

    /**
     * Show the form for creating a new affgallery.
     */
    public function create($gallery_id): View
    {
        return view('admin.pages.affgallery.form',  new AffgalleryViewModel(), get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AffgalleryRequest $request)
    {
        // return $request;
        $this->affgallery->createAffgallery($request->validated());
        session()->flash('success', TranslationHelper::translate('Operation Success'));
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($gallery_id, Affgallery $affgallery): View
    {
        return view('admin.pages.affgallery.form',  new AffgalleryViewModel($affgallery), compact('gallery_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AffgalleryRequest $request, Affgallery $affgallery, $gallery_id): RedirectResponse
    {
       
        // return $request;
        $this->affgallery->updateAffgallery($affgallery, $request->validated());
        session()->flash('success', TranslationHelper::translate('Successfully Updated'));
        return redirect()->route('admin.aff_gallery.index', ['gallery_id' => $gallery_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Affgallery $affgallery, $gallery_id): JsonResponse
    {
        $this->affgallery->deleteAffgallery($affgallery);
        return response()->json(['status' => 'success', 'message' => TranslationHelper::translate('Successfully Deleted')]);
    }

    // public function reorder(Affgallery $affgallery)
    // {
    //     return $this->affgallery->reorder($affgallery, 'name', 'admin.pages.affgallery.reorder', 1);
    // }

    // public function saveReorder(Request $request, Affgallery $affgallery)
    // {
    //     $all_entries = $request->input('tree');
    //     return $this->affgallery->saveReorder($all_entries, $affgallery);
    // }
}
