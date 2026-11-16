<?php

/**
 * API ServiceController
 *
 * Read-only REST API controller for software engineering service offerings.
 */

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserApp\ServiceResource;
use App\Services\ServiceCatalogService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class ServiceController extends Controller
{
    use ApiResponseTrait;

    public function __construct(
        private readonly ServiceCatalogService $serviceCatalogService,
    ) {}

    /**
     * List active software engineering services.
     */
    public function index(): JsonResponse
    {
        $services = $this->serviceCatalogService->getActive();

        return $this->success_response(
            ServiceResource::collection($services),
            'Services retrieved successfully'
        );
    }
}

