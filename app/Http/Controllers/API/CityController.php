<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserApp\CityResource;
use App\Http\Resources\UserApp\PaginationCollection;
use App\Models\City;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class CityController extends Controller
{


    use ApiResponseTrait;
    public function index(Request $request)
    {
        try {
            $cities = City::paginate($request->limit ?? 15);
            $pagination = new PaginationCollection($cities);
            $data = CityResource::collection($cities);

            return $this->success_response_with_pagination($data, 'Paint Categories List', $pagination);
        } catch (\Exception $e) {
            return $this->error_response('Some Error Happened', 500);
        }
    }



    // public function index()
    // {
    //     try {
    //         // (في هذه الحالة name فقط)
    //         $cities = City::select('name')->get();
    //         return response()->json([
    //             'success' => true,
    //             'data' => $cities
    //         ], 200);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'خطأ أثناء جلب المدن',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }

}
