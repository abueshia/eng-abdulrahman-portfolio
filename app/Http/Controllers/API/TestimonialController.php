<?php

/**
 * API TestimonialController
 *
 * Read-only REST API controller for client testimonials and reviews.
 */

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserApp\TestimonialResource;
use App\Services\TestimonialService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class TestimonialController extends Controller
{
    use ApiResponseTrait;

    public function __construct(
        private readonly TestimonialService $testimonialService,
    ) {}

    /**
     * List active client testimonials.
     */
    public function index(): JsonResponse
    {
        $testimonials = $this->testimonialService->getActive();

        return $this->success_response(
            TestimonialResource::collection($testimonials),
            'Testimonials retrieved successfully'
        );
    }
}

