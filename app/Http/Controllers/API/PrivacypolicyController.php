<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserApp\PaginationCollection;
use App\Http\Resources\UserApp\PrivacypolicyResource;
use App\Models\Privacypolicy;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class PrivacypolicyController extends Controller
{


    use ApiResponseTrait;
    public function index(Request $request)
    {
        try {
            $privacypolicy = Privacypolicy::paginate($request->limit ?? 15);
            $data = PrivacypolicyResource::collection($privacypolicy);
            $pagination = new PaginationCollection($privacypolicy);

            return $this->success_response_with_pagination($data, 'Paint Categories List', $pagination);
        } catch (\Exception $e) {
            return $this->error_response('Some Error Happened', 500);
        }
    }
    
    // public function index()
    // {
    //     try {
    //         // جلب الوصف فقط ومرة واحدة فقط
    //         $privacypolicy = Privacypolicy::select('description')->first();
    //         return response()->json([
    //             'success' => true,
    //             'data' => $privacypolicy
    //         ], 200);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'خطأ أثناء جلب سياسة الخصوصية',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }


}
