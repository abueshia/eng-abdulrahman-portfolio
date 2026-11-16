<?php

/**
 * API FaqController
 *
 * Read-only REST API controller for Frequently Asked Questions.
 */

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserApp\FaqResource;
use App\Services\FaqService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class FaqController extends Controller
{
    use ApiResponseTrait;

    public function __construct(
        private readonly FaqService $faqService,
    ) {}

    /**
     * List active FAQs ordered by sort_order.
     */
    public function index(): JsonResponse
    {
        $faqs = $this->faqService->getActive();

        return $this->success_response(
            FaqResource::collection($faqs),
            'FAQs retrieved successfully'
        );
    }
}

