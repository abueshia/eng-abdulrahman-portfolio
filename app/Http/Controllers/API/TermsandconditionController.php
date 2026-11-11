<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserApp\PaginationCollection;
use App\Http\Resources\UserApp\TermsandconditionResource;
use App\Models\Termsandcondition;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class TermsandconditionController extends Controller
{


    use ApiResponseTrait;
    public function index(Request $request)
    {
        try {
            $termsandcondition = Termsandcondition::paginate($request->limit ?? 15);
            $data = TermsandconditionResource::collection($termsandcondition);
            $pagination = new PaginationCollection($termsandcondition);

            return $this->success_response_with_pagination($data, 'Paint Categories List', $pagination);
        } catch (\Exception $e) {
            return $this->error_response('Some Error Happened', 500);
        }
    }
    
    
    // public function index()
    // {
    //     try {
    //         // جلب الوصف فقط ومرة واحدة فقط
    //         $termsandcondition = Termsandcondition::select('description')->first();
    //         return response()->json([
    //             'success' => true,
    //             'data' => $termsandcondition
    //         ], 200);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'خطأ أثناء جلب الشروط والاحكام ',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }
}
