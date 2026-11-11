<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserApp\BranchesResource;
use App\Http\Resources\UserApp\CityResource;
use App\Http\Resources\UserApp\FavoritebranchesResource;
use App\Http\Resources\UserApp\OfferResource;
use App\Http\Resources\UserApp\PaginationCollection;
use App\Models\Branche;
use App\Models\City;
use App\Models\Offer;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class FavoriteoffersController extends Controller
{
    use ApiResponseTrait;

    

public function addFavoriteOffers(Request $request)
{
 $request->validate([
        'offer_id' => 'required|exists:offers,id',

    ]);

    $client = auth('client_api')->user();

    if (!$client) {
        return $this->error_response('User not authenticated.', 401); 
    }

    // التحقق إذا كان الفرع موجودًا في المفضلات بالفعل
    if ($client->favoriteOffer()->where('offer_id', $request->offer_id)->exists()) {
        return $this->error_response('This branch is already in your favorites.', 400);
    }

    // إضافة الفرع إلى المفضلات إذا لم يكن موجودًا
    $client->favoriteOffer()->attach($request->offer_id);

    return $this->success_response([], 'offer added to favorites successfully.');
}


    public function getFavoriteOffers()
    {
        $client = auth('client_api')->user();

        if (!$client) {
            return $this->error_response('لا يوجد داتا.', 401);
        }

        $FavoriteOffers = $client->favoriteOffer;

        return $this->success_response(OfferResource::collection($FavoriteOffers), 'تم استرجاع العروض المفضلة بنجاح.');
    }

    

    public function removeFavoriteOffers(Request $request)
    {
        $request->validate([
            'offer_id' => 'required|exists:offers,id',
        ]);

        $client = auth('client_api')->user();

        $client->favoriteOffer()->detach($request->offer_id);

        return $this->success_response([], 'offer removed from favorites successfully.');
    }

}





