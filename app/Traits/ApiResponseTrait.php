<?php

/**
 * ApiResponseTrait
 *
 * Standardized JSON response envelope trait for all public REST API controllers.
 * Preserves the exact response keys (`code`, `success`, `message`, `data`, `pagination`)
 * while supporting appropriate HTTP status codes.
 */

declare(strict_types=1);

namespace App\Traits;

use App\Http\Resources\UserApp\PaginationCollection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

trait ApiResponseTrait
{
    /**
     * Return a standardized JSON success response.
     */
    public function success_response(mixed $data = [], ?string $message = null, int $code = 200): JsonResponse
    {
        $httpStatus = ($code >= 200 && $code < 600) ? $code : 200;

        return response()->json([
            'code' => $code,
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $httpStatus);
    }

    /**
     * Return a standardized JSON success response with pagination metadata.
     */
    public function success_response_with_pagination(
        mixed $data = [],
        ?string $message = null,
        mixed $pagination = null,
        int $code = 200
    ): JsonResponse {
        if ($pagination === null) {
            if ($data instanceof ResourceCollection && $data->resource instanceof LengthAwarePaginator) {
                $pagination = new PaginationCollection($data->resource);
            } elseif ($data instanceof LengthAwarePaginator) {
                $pagination = new PaginationCollection($data);
            }
        }

        $httpStatus = ($code >= 200 && $code < 600) ? $code : 200;

        return response()->json([
            'code' => $code,
            'success' => true,
            'message' => $message,
            'pagination' => $pagination,
            'data' => $data,
        ], $httpStatus);
    }

    /**
     * Return a standardized JSON error response.
     */
    public function error_response(?string $message = null, int $code = 200, mixed $errors = null): JsonResponse
    {
        $payload = [
            'code' => $code,
            'success' => false,
            'message' => $message,
        ];

        if ($errors !== null) {
            $payload['errors'] = $errors;
        }

        $httpStatus = ($code >= 400 && $code < 600) ? $code : 200;

        return response()->json($payload, $httpStatus);
    }

    /**
     * Return a standardized 401 Unauthorized JSON response.
     */
    public function unauthorized_response(?string $message = 'Unauthorized'): JsonResponse
    {
        return $this->error_response($message, 401);
    }
}
