<?php

declare(strict_types=1);

namespace App\Traits;

trait ApiResponseTrait
{
    public function success_response($data = [], $message = null)
    {
        return response()->json(['code' => 200, 'success' => true, 'message' => $message, 'data' => $data]);
    }

    public function success_response_with_pagination($data = [], $message = null, $pagination = null)
    {
        return response()->json(['code' => 200, 'success' => true, 'message' => $message, 'pagination' => $pagination, 'data' => $data]);
    }

    public function error_response($message = null, $code = 200)
    {
        return response()->json(['code' => $code, 'success' => false, 'message' => $message]);
    }

    public function unauthorized_response($message = 'Unauthorized')
    {
        return $this->error_response($message, 401);
    }
}
