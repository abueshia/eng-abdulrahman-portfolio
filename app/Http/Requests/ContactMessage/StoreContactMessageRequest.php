<?php

/**
 * StoreContactMessageRequest
 *
 * Validates public contact message or project inquiry submissions from the
 * portfolio website or REST API, and converts validated data into ContactMessageData DTO.
 */

declare(strict_types=1);

namespace App\Http\Requests\ContactMessage;

use App\DTOs\ContactMessageData;
use App\Enums\ContactMessageTypeEnum;
use App\Http\Requests\BasePortfolioFormRequest;
use Illuminate\Validation\Rule;

class StoreContactMessageRequest extends BasePortfolioFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:150'],
            'phone' => ['nullable', 'string', 'max:50'],
            'subject' => ['nullable', 'string', 'max:255'],
            'service' => ['nullable', 'string', 'max:150'],
            'budget_range' => ['nullable', 'string', 'max:120'],
            'timeline' => ['nullable', 'string', 'max:120'],
            'message' => ['required', 'string', 'max:5000'],
            'type' => ['nullable', Rule::enum(ContactMessageTypeEnum::class)],
        ];
    }

    /**
     * Build a ContactMessageData DTO from the validated request and client metadata.
     */
    public function toDto(): ContactMessageData
    {
        return ContactMessageData::fromArray(
            validated: $this->validated(),
            ipAddress: $this->ip(),
            userAgent: $this->userAgent(),
        );
    }
}
