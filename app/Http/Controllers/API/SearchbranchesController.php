<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserApp\BranchesResource;
use App\Http\Resources\UserApp\ClientResource;
use App\Models\Branche;
use App\Models\Client;
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

class SearchbranchesController extends Controller
{
    use ApiResponseTrait, HandleUploadFile;


    // public function searchBranches(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //     ]);

    //     $branches = Branche::where('name', 'LIKE', '%' . $request->name . '%')->get();

    //     if ($branches->isEmpty()) {
    //         return $this->error_response('No branches found with the given name.', 404);
    //     }

    //     $data = BranchesResource::collection($branches);

    //     return $this->success_response($data, 'Branches search successful.');
    // }

    public function searchBranches(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $branches = Branche::where('name', 'LIKE', '%' . $request->name . '%')->get();

        // جمع البيانات باستخدام Resource (إذا كانت فارغة، ستُرجع قائمة فارغة)
        $data = BranchesResource::collection($branches);

        return $this->success_response($data, 'Branches search successful.');
    }
  


    
}
