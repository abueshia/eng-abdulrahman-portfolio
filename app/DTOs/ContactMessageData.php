<?php

/**
 * ContactMessageData DTO
 *
 * Immutable Data Transfer Object carrying validated public contact message or
 * project inquiry payload from web/API requests to ContactMessageService.
 */

declare(strict_types=1);

namespace App\DTOs;

use App\Enums\ContactMessageStatusEnum;
use App\Enums\ContactMessageTypeEnum;

readonly class ContactMessageData
{
    public function __construct(
        public string $name,
        public string $email,
        public string $message,
        public ?string $phone = null,
        public ?string $subject = null,
        public ?string $service = null,
        public ?string $budgetRange = null,
        public ?string $timeline = null,
        public ContactMessageTypeEnum $type = ContactMessageTypeEnum::GeneralContact,
        public ContactMessageStatusEnum $status = ContactMessageStatusEnum::New,
        public ?string $adminNotes = null,
        public ?string $ipAddress = null,
        public ?string $userAgent = null,
    ) {}

    /**
     * Build a ContactMessageData instance from validated request data and client metadata.
     *
     * @param  array<string, mixed>  $validated
     */
    public static function fromArray(
        array $validated,
        ?string $ipAddress = null,
        ?string $userAgent = null,
    ): self {
        $type = isset($validated['type']) && $validated['type'] !== ''
            ? ($validated['type'] instanceof ContactMessageTypeEnum
                ? $validated['type']
                : ContactMessageTypeEnum::from((string) $validated['type']))
            : ContactMessageTypeEnum::GeneralContact;

        $status = isset($validated['status']) && $validated['status'] !== ''
            ? ($validated['status'] instanceof ContactMessageStatusEnum
                ? $validated['status']
                : ContactMessageStatusEnum::from((string) $validated['status']))
            : ContactMessageStatusEnum::New;

        return new self(
            name: trim((string) $validated['name']),
            email: trim((string) $validated['email']),
            message: trim((string) $validated['message']),
            phone: isset($validated['phone']) && $validated['phone'] !== '' ? trim((string) $validated['phone']) : null,
            subject: isset($validated['subject']) && $validated['subject'] !== '' ? trim((string) $validated['subject']) : null,
            service: isset($validated['service']) && $validated['service'] !== '' ? trim((string) $validated['service']) : null,
            budgetRange: isset($validated['budget_range']) && $validated['budget_range'] !== '' ? trim((string) $validated['budget_range']) : null,
            timeline: isset($validated['timeline']) && $validated['timeline'] !== '' ? trim((string) $validated['timeline']) : null,
            type: $type,
            status: $status,
            adminNotes: isset($validated['admin_notes']) && $validated['admin_notes'] !== '' ? trim((string) $validated['admin_notes']) : null,
            ipAddress: $ipAddress ?? (isset($validated['ip_address']) ? (string) $validated['ip_address'] : null),
            userAgent: $userAgent ?? (isset($validated['user_agent']) ? (string) $validated['user_agent'] : null),
        );
    }

    /**
     * Convert the DTO into an Eloquent mass-assignable attributes array.
     *
     * @return array<string, mixed>
     */
    public function toAttributes(?int $sortOrder = null): array
    {
        $attributes = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'subject' => $this->subject,
            'service' => $this->service,
            'budget_range' => $this->budgetRange,
            'timeline' => $this->timeline,
            'message' => $this->message,
            'type' => $this->type->value,
            'status' => $this->status->value,
            'admin_notes' => $this->adminNotes,
            'ip_address' => $this->ipAddress,
            'user_agent' => $this->userAgent,
        ];

        if ($sortOrder !== null) {
            $attributes['sort_order'] = $sortOrder;
        }

        return $attributes;
    }
}
