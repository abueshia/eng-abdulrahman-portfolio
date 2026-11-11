<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Placecat\PlacecatRequest;
use App\Models\Placecat;
use App\Services\PlacecatService;
use App\ViewModels\PlacecatViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class PlacecatController extends Controller
{
    private $placecat;

    public function __construct()
    {
        $this->placecat = new PlacecatService();
    }

    /**
     * Display a listing of the placecat.
     */
    public function index(Request $request): View
    {
        // dd($request->all());
        return view('admin.pages.placecat.index');
    }

    public function table(DataTables $dataTables, Request $request)
    {
        $model = Placecat::ordered();

        return $dataTables->eloquent($model)->addIndexColumn()
            ->editColumn('id', function (Placecat $placecat) {
                return $placecat->id ?? '-';
            })
            ->editColumn('image', function (Placecat $placecat) {
                return "<img src=' " . $placecat->getFirstMediaUrl('placecats') . " ' width='100' />";
            })
            ->editColumn('title', function (Placecat $placecat) {
                return $placecat->title;
            })
            ->editColumn('created_at', function (Placecat $placecat) {
                return $placecat->created_at->format('d-m-Y h:i A') ?? '-';
            })
            ->addColumn('action', function (Placecat $placecat) {
                return view('admin.pages.placecat.buttons', compact('placecat'));
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
        $placecat = Placecat::find($id);
        return view('admin.pages.placecat.show', get_defined_vars());
    }

    /**
     * Show the form for creating a new placecat.
     */
    public function create(): View
    {
        return view('admin.pages.placecat.form',  new PlacecatViewModel());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlacecatRequest $request)
    {
        // return $request;
        $this->placecat->createPlacecat($request->validated());
        session()->flash('success', TranslationHelper::translate('Operation Success'));
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Placecat $placecat): View
    {
        return view('admin.pages.placecat.form',  new PlacecatViewModel($placecat));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlacecatRequest $request, Placecat $placecat): RedirectResponse
    {
        //        return $request;
        $this->placecat->updatePlacecat($placecat, $request->validated());
        session()->flash('success', TranslationHelper::translate('Successfully Updated'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Placecat $placecat): JsonResponse
    {
        $this->placecat->deletePlacecat($placecat);
        return response()->json(['status' => 'success', 'message' => TranslationHelper::translate('Successfully Deleted')]);
    }

    public function reorder(Placecat $placecat)
    {
        return $this->placecat->reorder($placecat, 'name', 'admin.pages.placecat.reorder', 1);
    }

    public function saveReorder(Request $request, Placecat $placecat)
    {
        $all_entries = $request->input('tree');
        return $this->placecat->saveReorder($all_entries, $placecat);
    }
}
