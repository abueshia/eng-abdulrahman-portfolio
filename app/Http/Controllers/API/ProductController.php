<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserApp\PaginationCollection;
use App\Http\Resources\UserApp\ProductResource;
use App\Models\Product;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    use ApiResponseTrait;
    public function index(Request $request)
    {
        // try {
            $product = Product::paginate($request->limit ?? 15);
            $data = ProductResource::collection($product);
            $pagination = new PaginationCollection($product);

            return $this->success_response_with_pagination($data, 'Product List', $pagination);
        // } catch (\Exception $e) {
        //     return $this->error_response('Some Error Happened', 500);
        // }
    }
    

    // public function index()
    // {
    //     try {
    //         $product = Product::select('name', 'description')->first();

    //         if ($product) {
    //             $product->image = $product->getImageUrl();
    //         }

    //         return response()->json([
    //             'success' => true,
    //             'data' => $product
    //         ], 200);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'خطأ أثناء جلب  المنتجات',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }


}
