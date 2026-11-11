<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProgramme\StoreProgrammeRequest;
use App\Http\Requests\Admin\UpdateProgramme\UpdateProgrammeRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Programme;
use App\Models\ProgrammeImage;
use App\Models\ProgrammeInclude;
use App\Models\ProgrammeItinerary;
use App\Models\ProgrammeItineraryItem;
use App\Models\Region;
use App\Models\TourType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgrammeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('auth:admin');
        // $this->middleware('permission:tour_type.read', ['only' => ['index']]);
        // $this->middleware('permission:tour_type.create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:tour_type.edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:tour_type.delete', ['only' => ['destroy']]);


        $this->middleware(['auth:admin', 'permission:programmes.read'], ['only' => ['index']]);
        $this->middleware(['auth:admin', 'permission:programmes.view_details'], ['only' => ['show']]);
        $this->middleware(['auth:admin', 'permission:programmes.create'], ['only' => ['create', 'store']]);
        $this->middleware(['auth:admin', 'permission:programmes.edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['auth:admin', 'permission:programmes.delete'], ['only' => ['destroy']]);
        $this->middleware(['auth:admin', 'permission:programmes.sort'], ['only' => [
            'reorder',
            'saveReorder'
        ]]);

    }

    
    public function index(Request $request)
    {
        $cities = City::select('id', 'name')->get();

        $countries = Country::select('id', 'name')->get();

        $programmes = Programme::query();

        if ($request->has('search') && $request->search != '') {
            $programmes = $programmes->where('name', 'like', '%' . $request->search . '%' );
        }
        if ($request->has('country_id') && $request->country_id != '') {
            $programmes = $programmes->where('country_id',   $request->country_id  );
        }
        if ($request->has('city_id') && $request->city_id != '') {
            $programmes = $programmes->where('city_id',   $request->city_id  );
        }
        if ($request->has('is_featured') && $request->is_featured != '') {
            $programmes = $programmes->where('is_featured',   $request->is_featured  );
        }
        if ($request->has('status') && $request->status != '') {
            $programmes = $programmes->where('status',   $request->status  );
        }
        $programmes = $programmes->paginate(15);
        return view('admin.pages.programme.index', get_defined_vars());
    }

    public function UpdateStatus($state)
    {
        Programme::findOrFail(request('id'))->update([
            'status' => $state
        ]);
    }

    public function updateFeatured($state)
    {
        Programme::findOrFail(request('id'))->update([
            'is_featured' => $state
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tour_types = TourType::get();
        $regions = Region::select('id', 'name')->get();
        $countries = Country::select('id', 'name')->get();

        return view('admin.pages.programme.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProgrammeRequest $request)
    {
    //    return $request;
        DB::beginTransaction();
        $programme = Programme::create([
            'name' => ['ar' => $request->name_ar, 'en' => $request->name_en,],

            // 'meta_title' => ['ar' => $request->meta_title_ar, 'en' => $request->meta_title_en,],
          

            'rate' => $request->rate,
            'star' => $request->star,
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
            'region_id' => $request->region_id,
            'location_name' => ['ar' => $request->location_name_ar, 'en' => $request->location_name_en,],
            'status' => $request->status,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'map' => $request->map,
            'description' => $request->description,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'group_size' => $request->group_size,
            'tour_type_id' => $request->tour_type_id,
            'duration' => $request->duration,
            'is_featured' => $request->is_featured,
            'price' => $request->price,
            'discount_type' => $request->discount_type,
            'discount' => $request->discount,
            'valid_from' => $request->valid_from,
            'valid_to' => $request->valid_to,
            'tax' => $request->tax,

            'email' => $request->email,
            'phone' => $request->phone,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'twitter' => $request->twitter,
            'gmail' => $request->gmail,

          
        ]);


        if ($request->has('main_image')) {
            $programme->storeFile($request->main_image);
        }

        if ($request->has('banner')) {
            $programme->storeFile($request->banner, '_banners');
        }

        if ($request->has('images')) {
            foreach ($request->images as $image) {
                $programmeImage = ProgrammeImage::create([
                    'programme_id' => $programme->id
                ]);
                $programmeImage->storeFile($image);
            }
        }

        if ($request->has('itinerary') && $request->itinerary != null) {
            foreach ($request->itinerary as $key => $day) {
                $new_day = ProgrammeItinerary::create([
                    'programme_id' => $programme->id
                ]);
                foreach ($day as $day_item) {
                    ProgrammeItineraryItem::create([
                        'programme_itinerary_id' => $new_day->id,
                        'details' => $day_item,
                    ]);
                }
            }
        }

        if ($request->has('includes') && $request->includes != null) {
            foreach ($request->includes as $key => $include) {

                $new_include = ProgrammeInclude::create([
                    'programme_id' => $programme->id,
                    'details' => $include
                ]);
            }
        }

        DB::commit();

        return redirect()->route('admin.programme.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Programme $programme)
    {
        return $programme;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Programme $programme)
    {
        $programme = Programme::with(

            ['programmeItinerary' => function ($q) {
                $q->with('programmeItineraryItems');
            },
                'country',
                'city',
                'region',
                'tourType',
                'programmeImages',
                'programmeIncludes']
        )->findOrFail($programme->id);
        $tour_types = TourType::get();
        $regions = Region::select('id', 'name')->get();
        $countries = Country::select('id', 'name')->get();
        $cities = City::select('id', 'name')->get();

        return view('admin.pages.programme.create', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProgrammeRequest $request, Programme $programme)
    {
        DB::beginTransaction();

        $programme->update([
            'name' => ['ar' => $request->name_ar, 'en' => $request->name_en,],
            // 'meta_title' => ['ar' => $request->meta_title_ar, 'en' => $request->meta_title_en,],
            
            'rate' => $request->rate,
            'star' => $request->star,
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
            'region_id' => $request->region_id,
            'location_name' => ['ar' => $request->location_name_ar, 'en' => $request->location_name_en,],
            'status' => $request->status,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'map' => $request->map,
            'description' => $request->description,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'group_size' => $request->group_size,
            'tour_type_id' => $request->tour_type_id,
            'duration' => $request->duration,

            'is_featured' => $request->is_featured,

            'price' => $request->price,
            'discount_type' => $request->discount_type,
            'discount' => $request->discount,
            'valid_from' => $request->valid_from,
            'valid_to' => $request->valid_to,
            'tax' => $request->tax,

            'email' => $request->email,
            'phone' => $request->phone,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'twitter' => $request->twitter,
            'gmail' => $request->gmail,


        ]);


        if ($request->has('main_image')) {
            $programme->updateFile($request->main_image);
        }

//
        if ($request->has('banner')) {
            $programme->updateFile($request->banner, '_banners');
        }
//
        if ($request->has('images')) {
            foreach ($request->images as $image) {
                $programmeImage = ProgrammeImage::create([
                    'programme_id' => $programme->id
                ]);
                $programmeImage->storeFile($image);
            }
        }
//
        if ($request->has('itinerary') && $request->itinerary != null) {
            $programme->programmeItinerary()->delete();
            foreach ($request->itinerary as $key => $day) {
                $new_day = ProgrammeItinerary::create([
                    'programme_id' => $programme->id
                ]);
                foreach ($day as $day_item) {
                    ProgrammeItineraryItem::create([
                        'programme_itinerary_id' => $new_day->id,
                        'details' => $day_item,
                    ]);
                }
            }
        }
//
        if ($request->has('includes') && $request->includes != null) {
            $programme->programmeIncludes()->delete();
            foreach ($request->includes as $key => $include) {
                $new_include = ProgrammeInclude::create([
                    'programme_id' => $programme->id,
                    'details' => $include
                ]);
            }
        }
        DB::commit();

//        return $programme = Programme::with(
//
//            ['programmeItinerary' => function ($q) {
//                $q->with('programmeItineraryItems');
//            },
//                'media',
//                'country',
//                'city',
//                'region',
//                'tourType',
//                'programmeImages',
//                'programmeIncludes']
//        )->findOrFail($programme->id);

        return redirect()->route('admin.programme.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Programme $programme)
    {
        if ($programme) {
            $programme->delete();
        }
        return redirect()->route('admin.programme.index');
    }
}
