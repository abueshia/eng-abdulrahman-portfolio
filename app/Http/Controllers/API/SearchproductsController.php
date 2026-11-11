<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserApp\ClientResource;
use App\Http\Resources\UserApp\ProductResource;
use App\Models\Client;
use App\Models\Otp;
use App\Models\Pointssetting;
use App\Models\Product;
// use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponseTrait;
use App\Traits\HandleUploadFile;
// use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SearchproductsController extends Controller
{
    use ApiResponseTrait, HandleUploadFile;

    public function SearchProducts(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $products = Product::where('name', 'LIKE', '%' . $request->name . '%')->get();

        if ($products->isEmpty()) {
            return $this->error_response('No products found with the given name.', 404);
        }

        $data = ProductResource::collection($products);

        return $this->success_response($data, 'Products search successful.');
    }



    // public function SearchProducts(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //     ]);

    //     $products = Product::where('name', 'LIKE', '%' . $request->name . '%')->get();

    //     if ($products->isEmpty()) {
    //         return response()->json([
    //             'code' => 404,
    //             'success' => false,
    //             'message' => 'No products found with the given name.',
    //             'data' => null,
    //         ]);
    //     }

    //     // إرجاع النتائج إذا وجدت
    //     return response()->json([
    //         'code' => 200,
    //         'success' => true,
    //         'message' => 'Products search successful.',
    //         'data' => $products,
    //     ]);
    // }


}
