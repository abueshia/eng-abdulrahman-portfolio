<?php

namespace App\Http\Controllers\Admin;

use App\Models\TourType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\TourTypeStore\TourTypeStoreRequest as TourTypeStoreTourTypeStoreRequest;
use App\Http\Requests\admin\TourTypeUpdateRequest as AdminTourTypeUpdateRequest;
// use App\Http\Requests\Dashboard\TourTypeStoreRequest;
use App\Http\Requests\Admin\TourTypeUpdate\TourTypeUpdateRequest;

use App\Http\Requests\Admin\TourTypeStore\TourTypeStoreRequest;


class TourTypeController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth:admin');
            //    $this->middleware('permission:tour_type.read', ['only' => ['index']]);
            //    $this->middleware('permission:tour_type.create', ['only' => ['create', 'store']]);
            //    $this->middleware('permission:tour_type.edit', ['only' => ['edit', 'update']]);
            //    $this->middleware('permission:tour_type.delete', ['only' => ['destroy']]);

        $this->middleware(['auth:admin', 'permission:tour_type.view_all'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:tour_type.read'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:tour_type.create'], ['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:tour_type.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:tour_type.delete'], ['only' => ['destroy']]);
        $this->middleware(['auth:admin', 'permission:tour_type.sort'], ['only' => [
            'reorder',
            'saveReorder'
        ]]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tour_types = TourType::query()->search()->paginate(15);
        return view('admin.pages.tour_type.index',get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.tour_type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TourTypeStoreRequest $request)
    {
        TourType::Create([
          'name'=>['ar'=>$request->name_ar,'en'=>$request->name_en],
        ]);

        return redirect()->route('admin.tour_type.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(TourType $tour_type)
    {
        //
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TourType $tour_type)
    {
        return view('admin.pages.tour_type.create', get_defined_vars());
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(TourTypeUpdateRequest $request, TourType $tour_type)
    {
        $tour_type->update([
          'name' => ['ar'=>$request->name_ar,'en'=>$request->name_en],
        ]);
        return redirect()->route('admin.tour_type.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TourType $tour_type)
    {
        if ($tour_type) {
         $tour_type->delete();
        }
        return redirect()->route('admin.tour_type.index');
    }
}
