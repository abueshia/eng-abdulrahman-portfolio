<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserApp\BannerResource;
use App\Http\Resources\UserApp\ContactResource;
use App\Http\Resources\UserApp\PaginationCollection;
use App\Http\Resources\UserApp\PrivacypolicyResource;
use App\Http\Resources\UserApp\VoucherspageResource;
use App\Models\Banner;
use App\Models\Contact;
use App\Models\Privacypolicy;
use App\Models\Voucherspage;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class VoucherspageController extends Controller
{

   use ApiResponseTrait;
    public function index(Request $request)
    {
        try {
            $Voucherspage = Voucherspage::paginate($request->limit ?? 15);
            $data = VoucherspageResource::collection($Voucherspage);
            $pagination = new PaginationCollection($Voucherspage);
            return $this->success_response_with_pagination($data, 'Voucherspage List', $pagination);
        } catch (\Exception $e) {
            return $this->error_response('Some Error Happened', 500);
        }
    }
}
