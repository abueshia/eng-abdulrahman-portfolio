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

class FavoritebranchesController extends Controller
{

    use ApiResponseTrait;

public function addFavoriteBranch(Request $request)
{
 $request->validate([
        'branch_id' => 'required|exists:branches,id',
        // 'is_favorite' => 'required|boolean',
            // is_favorite
    ]);

    $client = auth('client_api')->user();

    if (!$client) {
        return $this->error_response('User not authenticated.', 401); 
    }

    // التحقق إذا كان الفرع موجودًا في المفضلات بالفعل
    if ($client->favoriteBranches()->where('branch_id', $request->branch_id)->exists()) {
        return $this->error_response('This branch is already in your favorites.', 400);
    }

    // إضافة الفرع إلى المفضلات إذا لم يكن موجودًا
    $client->favoriteBranches()->attach($request->branch_id);

    return $this->success_response([], 'Branch added to favorites successfully.');
}



    // public function getFavoriteBranches()
    // {
    //     $client = auth('client_api')->user();

    //     $favoriteBranches = $client->favoriteBranches;

    //     return $this->success_response(BranchesResource::collection($favoriteBranches), 'Favorite branches retrieved successfully.');
    // }


    public function getFavoriteBranches()
    {
        $client = auth('client_api')->user();

        if (!$client) {
            return $this->error_response('لا يوجد داتا.', 401);
        }

        $favoriteBranches = $client->favoriteBranches;

        return $this->success_response(BranchesResource::collection($favoriteBranches), 'تم استرجاع الفروع المفضلة بنجاح.');
    }

    
    public function removeFavoriteBranch(Request $request)
    {
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
        ]);

        $client = auth('client_api')->user();

        $client->favoriteBranches()->detach($request->branch_id);

        return $this->success_response([], 'Branch removed from favorites successfully.');
    }

}





