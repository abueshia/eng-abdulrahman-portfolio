<?php

/**
 * API MessageController
 *
 * Handles public contact message and project inquiry submissions via REST API.
 * Uses StoreContactMessageRequest (with Honeypot protection) and ContactMessageService.
 */

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactMessage\StoreContactMessageRequest;
use App\Http\Resources\UserApp\MessageResource;
use App\Services\ContactMessageService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class MessageController extends Controller
{
    use ApiResponseTrait;

    public function __construct(
        private readonly ContactMessageService $contactMessageService,
    ) {}

    /**
     * Store a new public contact message or project inquiry (`POST /api/v1/contact`).
     */
    public function store(StoreContactMessageRequest $request): JsonResponse
    {
        $message = $this->contactMessageService->submit($request->toDto());

        return $this->success_response(
            new MessageResource($message),
            'Message created successfully',
            201
        );
    }

    /**
     * Backward-compatible endpoint handler for `POST /api/message`.
     */
    public function CreateMessage(StoreContactMessageRequest $request): JsonResponse
    {
        return $this->store($request);
    }
}
