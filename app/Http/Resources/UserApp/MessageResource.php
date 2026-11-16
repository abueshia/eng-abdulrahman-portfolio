<?php

/**
 * MessageResource
 *
 * Public API representation of a submitted ContactMessage.
 * Strictly excludes internal fields (`admin_notes`, `ip_address`, `user_agent`).
 */

declare(strict_types=1);

namespace App\Http\Resources\UserApp;

use App\Enums\ContactMessageTypeEnum;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin ContactMessage
 */
class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        $typeEnum = $this->type instanceof ContactMessageTypeEnum
            ? $this->type
            : ContactMessageTypeEnum::tryFrom((string) $this->type);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'subject' => $this->subject,
            'service' => $this->service,
            'budget_range' => $this->budget_range,
            'timeline' => $this->timeline,
            'type' => $typeEnum?->value ?? (string) $this->type,
            'type_label' => $typeEnum?->label(),
            'message' => $this->message,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
