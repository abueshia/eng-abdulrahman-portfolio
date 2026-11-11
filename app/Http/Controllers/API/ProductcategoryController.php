<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserApp\PaginationCollection;
use App\Http\Resources\UserApp\PaintsCategoryResource;
use App\Http\Resources\UserApp\ProductcategoryResource;
use App\Models\Paintscategory;
use App\Models\Productcategory;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class ProductcategoryController extends Controller
{
    use ApiResponseTrait;
    public function index(Request $request)
    {
        try {
            $productcategory = Productcategory::paginate($request->limit ?? 15);
            $data = ProductcategoryResource::collection($productcategory);
            $pagination = new PaginationCollection($productcategory);

            return $this->success_response_with_pagination($data, 'Paint Categories List', $pagination);

        } catch (\Exception $e) {
            return $this->error_response('Some Error Happened', 500);
        }
    }


}
