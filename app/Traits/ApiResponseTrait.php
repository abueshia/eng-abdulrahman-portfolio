<?php

namespace App\Traits;

trait ApiResponseTrait
{
    // public function success_response ($data = array(), $message = NULL) {
    //     return response()->json(['code' => 200, 'success' => true, 'message' => $message, 'data' => $data]);
    // }
    // public function success_response_with_pagination ($data = array(), $message = NULL, $pagination=null) {
    //     return response()->json(['code' => 200, 'success' => true, 'message' => $message, 'pagination' => $pagination, 'data' => $data]);
    // }

    // public function error_response ($message = NULL, $code = 200) {
    //     return response()->json(['code' => $code, 'success' => false, 'message' => $message]);
    // }

    // public function unauthorized_response($message = 'Unauthorized')
    // {
    //     return $this->error_response($message, 401);
    // }

    public function success_response($data = array(), $message = NULL)
    {
        return response()->json(['code' => 200, 'success' => true, 'message' => $message, 'data' => $data]);
    }

    public function success_response_with_pagination($data = array(), $message = NULL, $pagination = null)
    {
        return response()->json(['code' => 200, 'success' => true, 'message' => $message, 'pagination' => $pagination, 'data' => $data]);
    }

    public function error_response($message = NULL, $code = 200)
    {
        return response()->json(['code' => $code, 'success' => false, 'message' => $message]);
    }

    public function unauthorized_response($message = 'Unauthorized')
    {
        return $this->error_response($message, 401);
    }
    
}
