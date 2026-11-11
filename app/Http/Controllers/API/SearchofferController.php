<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserApp\BranchesResource;
use App\Http\Resources\UserApp\ClientResource;
use App\Http\Resources\UserApp\OfferResource;
use App\Models\Branche;
use App\Models\Client;
use App\Models\Offer;
use App\Models\Otp;
use App\Models\Pointssetting;
// use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponseTrait;
use App\Traits\HandleUploadFile;
// use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SearchofferController extends Controller
{
    use ApiResponseTrait, HandleUploadFile;


    // public function searchOffer(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //     ]);

    //     $offer = Offer::where('name', 'LIKE', '%' . $request->name . '%')->get();

    //     if ($offer->isEmpty()) {
    //         return $this->error_response('No offer found with the given name.', 404);
    //     }

    //     $data = OfferResource::collection($offer);

    //     return $this->success_response($data, 'Branches search successful.');
    // }


    public function searchOffer(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // جلب النتائج
        $offer = Offer::where('name', 'LIKE', '%' . $request->name . '%')->get();

        // تحويل النتائج إلى Resource
        $data = OfferResource::collection($offer);

        // إرجاع استجابة ناجحة مع النتائج (حتى إذا كانت فارغة)
        return $this->success_response($data, 'Offers search successful.');
    }


    
}
