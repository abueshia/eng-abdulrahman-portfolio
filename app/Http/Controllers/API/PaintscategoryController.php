<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserApp\PaginationCollection;
use App\Http\Resources\UserApp\PaintsCategoryResource;
use App\Models\Paintscategory;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class PaintscategoryController extends Controller
{
    use ApiResponseTrait;
    public function index(Request $request)
    {
        try {
            $paintscategory = Paintscategory::paginate($request->limit ?? 15);
            $data = PaintsCategoryResource::collection($paintscategory);
            $pagination = new PaginationCollection($paintscategory);

            return $this->success_response_with_pagination($data, 'Paint Categories List', $pagination);

        } catch (\Exception $e) {
            return $this->error_response('Some Error Happened', 500);
        }
    }


}
