<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserApp\BannerResource;
use App\Http\Resources\UserApp\PaginationCollection;
use App\Http\Resources\UserApp\PrivacypolicyResource;
use App\Models\Banner;
use App\Models\Privacypolicy;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class BannerController extends Controller
{


    use ApiResponseTrait;
    public function index(Request $request)
    {
        try {
            $Banner = Banner::paginate($request->limit ?? 15);
            $data = BannerResource::collection($Banner);
            $pagination = new PaginationCollection($Banner);
            return $this->success_response_with_pagination($data, 'Paint Banner List', $pagination);
        } catch (\Exception $e) {
            return $this->error_response('Some Error Happened', 500);
        }
    }
    
 


}
