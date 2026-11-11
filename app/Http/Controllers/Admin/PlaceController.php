<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\TranslationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Place\PlaceRequest;
use App\Models\Place;
use App\Models\Placecat;
use App\Services\PlaceService;
use App\ViewModels\PlaceViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class PlaceController extends Controller
{
    private $place;

    public function __construct()
    {
        $this->place = new PlaceService();
    }

    /**
     * Display a listing of the place.
     */
    public function index(Request $request): View
    {
        // dd($request->all());
        return view('admin.pages.place.index');
    }


    public function table(DataTables $dataTables, Request $request)
    {
        $model = Place::with('Placecats')->ordered();

        return $dataTables->eloquent($model)->addIndexColumn()
            ->editColumn('id', function (Place $place) {
                return $place->id ?? '-';
            })->editColumn('image', function (Place $place) {
                return "<img width='100' src=' " . $place->getFirstMediaUrl('places') . " '/>";
            })->editColumn('title', function (Place $place) {
                return $place->title;
        })->editColumn('Placecats', function (Place $place) {
            return $place->Placecats->name ?? '-';

            })->editColumn('created_at', function (Place $place) {
                return $place->created_at->format('d-m-Y h:i A') ?? '-';
            })->addColumn('action', function (Place $place) {
                return view('admin.pages.place.buttons', compact('place'));
            })
            ->rawColumns(['image', 'action'])
            ->startsWithSearch()
            ->make(true);
    }

    // public function table(DataTables $dataTables, Request $request)
    // {
    //     $model = Place::ordered();

    //     return $dataTables->eloquent($model)->addIndexColumn()
    //         ->editColumn('id', function (Place $place) {
    //             return $place->id ?? '-';
    //         })->editColumn('image', function (Place $place) {
    //             return "<img width='100' src=' " . $place->getFirstMediaUrl('places') . " '/>";
    //         })->editColumn('title', function (Place $place) {
    //             return $place->title;
    //         })->editColumn('created_at', function (Place $place) {
    //             return $place->created_at->format('d-m-Y h:i A') ?? '-';
    //         })->addColumn('action', function (Place $place) {
    //             return view('admin.pages.place.buttons', compact('place'));
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
        $place = Place::find($id);
        return view('admin.pages.place.show', get_defined_vars());
    }

    /**
     * Show the form for creating a new place.
     */
    public function create(): View
    {
        return view('admin.pages.place.form',  new PlaceViewModel());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlaceRequest $request)
    {
        // return $request;
        $this->place->createPlace($request->validated());
        session()->flash('success', TranslationHelper::translate('Operation Success'));
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Place $place): View
    {
        return view('admin.pages.place.form',  new PlaceViewModel($place));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlaceRequest $request, Place $place): RedirectResponse
    {
        //        return $request;
        $this->place->updatePlace($place, $request->validated());
        session()->flash('success', TranslationHelper::translate('Successfully Updated'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Place $place): JsonResponse
    {
        $this->place->deletePlace($place);
        return response()->json(['status' => 'success', 'message' => TranslationHelper::translate('Successfully Deleted')]);
    }

    public function reorder(Place $place)
    {
        return $this->place->reorder($place, 'name', 'admin.pages.place.reorder', 1);
    }

    public function saveReorder(Request $request, Place $place)
    {
        $all_entries = $request->input('tree');
        return $this->place->saveReorder($all_entries, $place);
    }
}
