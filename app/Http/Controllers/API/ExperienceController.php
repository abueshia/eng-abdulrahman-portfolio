<?php

/**
 * API ExperienceController
 *
 * Read-only REST API controller for the professional career timeline.
 */

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserApp\ExperienceResource;
use App\Services\ExperienceService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class ExperienceController extends Controller
{
    use ApiResponseTrait;

    public function __construct(
        private readonly ExperienceService $experienceService,
    ) {}

    /**
     * List active career experiences ordered chronologically.
     */
    public function index(): JsonResponse
    {
        $experiences = $this->experienceService->getActiveTimeline();

        return $this->success_response(
            ExperienceResource::collection($experiences),
            'Experiences retrieved successfully'
        );
    }
}

