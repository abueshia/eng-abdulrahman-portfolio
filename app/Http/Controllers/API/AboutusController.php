<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserApp\AboutResource;
use App\Http\Resources\UserApp\PaginationCollection;
use App\Models\About;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class AboutusController extends Controller
{

    // public function index()
    // {
    //     try {
    //         // جلب العنوان والوصف فقط
    //         $aboutus = About::select('title', 'description')->first();
    //         return response()->json([
    //             'success' => true,
    //             'data' => $aboutus
    //         ], 200);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'خطأ أثناء جلب الشروط والأحكام',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }


    use ApiResponseTrait;
    public function index(Request $request)
    {
        try {
            $aboutus = About::paginate($request->limit ?? 15);
            $data = AboutResource::collection($aboutus);
            $pagination = new PaginationCollection($aboutus);

            return $this->success_response_with_pagination($data, 'Paint Categories List', $pagination);
        } catch (\Exception $e) {
            return $this->error_response('Some Error Happened', 500);
        }
    }

}
