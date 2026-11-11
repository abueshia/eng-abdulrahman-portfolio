<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserApp\BranchesResource;
use App\Http\Resources\UserApp\CityResource;
use App\Http\Resources\UserApp\FavoritebranchesResource;
use App\Http\Resources\UserApp\OfferResource;
use App\Http\Resources\UserApp\PaginationCollection;
use App\Http\Resources\UserApp\ProductResource;
use App\Models\Branche;
use App\Models\City;
use App\Models\Offer;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class FavoriteproductsController extends Controller
{

    use ApiResponseTrait;
    // إضافة منتج إلى المفضلة
    // إضافة منتج إلى المفضلة
    public function addFavoriteProduct(Request $request)
    {

        $request->validate([
            'product_id' => 'required|exists:products,id',
            // 'is_favorite' => 'required|boolean',
        ]);

        // جلب العميل من الـ API
        $client = auth('client_api')->user();

        // التحقق من وجود العميل
        if (!$client) {
            return $this->error_response('User not authenticated.', 401); 
        }

        // التحقق إذا كان المنتج موجودًا في المفضلات بالفعل
        if ($client->favoriteProducts()->where('product_id', $request->product_id)->exists()) {
            return $this->error_response('This product is already in your favorites.', 400);
        }

        // إضافة المنتج إلى المفضلات
        $client->favoriteProducts()->attach($request->product_id);

        return $this->success_response([], 'Product added to favorites successfully.');
    }




    
    public function getFavoriteProducts()
    {
        $client = auth('client_api')->user();


        if (!$client) {
            return $this->error_response('لا يوجد داتا.', 401);
        }

        $favoriteProducts = $client->favoriteProducts;

        return $this->success_response(ProductResource::collection($favoriteProducts), 'Favorite products retrieved successfully.');
    }



    // إزالة منتج من المفضلة
    public function removeFavoriteProducts(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $client = auth('client_api')->user();

        $client->favoriteProducts()->detach($request->product_id);

        return $this->success_response([], 'Product removed from favorites successfully.');
    }
    
}
