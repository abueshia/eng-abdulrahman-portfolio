<?php

/**
 * API MessageController
 *
 * Handles public contact message and project inquiry submissions via REST API.
 */

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Enums\ContactMessageStatusEnum;
use App\Enums\ContactMessageTypeEnum;
use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class MessageController extends Controller
{
    use ApiResponseTrait;

    /**
     * Validate and store a new contact message from the API.
     */
    public function CreateMessage(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'message' => 'required|string',
                'name' => 'required|string|max:100',
                'phone' => 'required|string|regex:/^[0-9]{10,15}$/',
                'email' => 'nullable|email|max:255',
            ]);

            $message = ContactMessage::query()->create([
                'message' => $validated['message'],
                'name' => $validated['name'],
                'phone' => $validated['phone'],
                'email' => $validated['email'] ?? null,
                'type' => ContactMessageTypeEnum::GeneralContact,
                'status' => ContactMessageStatusEnum::New,
                'ip_address' => $request->ip(),
                'user_agent' => (string) $request->userAgent(),
            ]);

            return $this->success_response($message, 'Message created successfully', 201);
        } catch (ValidationException $e) {
            return $this->error_response('Validation failed', 422, $e->errors());
        }
    }
}
