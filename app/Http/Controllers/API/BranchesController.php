<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserApp\BranchesResource;
use App\Http\Resources\UserApp\CityResource;
use App\Http\Resources\UserApp\PaginationCollection;
use App\Models\Branche;
use App\Models\City;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class BranchesController extends Controller
{


    use ApiResponseTrait;
    public function index(Request $request)
    {
        // try {
            $branche = Branche::with('offers' , 'offers.products')->paginate($request->limit ?? 15);
            $data = BranchesResource::collection($branche);
            $pagination = new PaginationCollection($branche);

            return $this->success_response_with_pagination($data, 'Branche  List', $pagination);
        // } catch (\Exception $e) {

        //     return $this->error_response('Some Error Happened', 500);
        // }
    }

}
