<?php

/**
 * API CredentialController
 *
 * Read-only REST API controller for academic degrees, professional certificates,
 * courses, and awards.
 */

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Enums\CredentialTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserApp\CredentialResource;
use App\Services\CredentialService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CredentialController extends Controller
{
    use ApiResponseTrait;

    public function __construct(
        private readonly CredentialService $credentialService,
    ) {}

    /**
     * List active credentials with optional type filter.
     */
    public function index(Request $request): JsonResponse
    {
        $typeParam = $request->query('type');
        $typeEnum = is_string($typeParam) && $typeParam !== ''
            ? CredentialTypeEnum::tryFrom($typeParam)
            : null;

        $credentials = $this->credentialService->getActive($typeEnum);

        return $this->success_response(
            CredentialResource::collection($credentials),
            'Credentials retrieved successfully'
        );
    }
}

