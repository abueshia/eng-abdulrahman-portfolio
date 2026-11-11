<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserApp\ClientResource;
use App\Http\Resources\UserApp\CouponResource;
use App\Http\Resources\UserApp\GroupResource;
use App\Http\Resources\UserApp\NotificationResource;
use App\Http\Resources\UserApp\PaginationCollection;
use App\Http\Resources\UserApp\PointssettingResource;
use App\Models\Client;
use App\Models\Coupon;
use App\Models\Group;
use App\Models\Notification;
use App\Models\Otp;
use App\Models\Pointssetting;
use App\Models\Voucherspage;
// use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponseTrait;
use App\Traits\HandleUploadFile;
use Carbon\Carbon;
// use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class NotificationController extends Controller
{
    use ApiResponseTrait, HandleUploadFile;
    // use Illuminate\Support\Carbon;


    public function index(Request $request)
    {
        try {
            $Notification = Notification::paginate($request->limit ?? 15);
            $data = NotificationResource::collection($Notification);
            $pagination = new PaginationCollection($Notification);
            return $this->success_response_with_pagination($data, 'Notification List', $pagination);
        } catch (\Exception $e) {
            return $this->error_response('Some Error Happened', 500);
        }
    }
}
