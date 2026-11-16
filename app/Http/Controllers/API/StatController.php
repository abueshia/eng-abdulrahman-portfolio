<?php

/**
 * API StatController
 *
 * Read-only REST API controller for numerical portfolio statistics.
 */

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserApp\StatResource;
use App\Services\StatService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class StatController extends Controller
{
    use ApiResponseTrait;

    public function __construct(
        private readonly StatService $statService,
    ) {}

    /**
     * List active numerical statistics ordered by sort_order.
     */
    public function index(): JsonResponse
    {
        $stats = $this->statService->getActive();

        return $this->success_response(
            StatResource::collection($stats),
            'Statistics retrieved successfully'
        );
    }
}

