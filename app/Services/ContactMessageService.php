<?php

/**
 * ContactMessageService
 *
 * Manages public contact message and project inquiry submissions,
 * status transitions, admin notes, and dashboard analytics.
 */

declare(strict_types=1);

namespace App\Services;

use App\DTOs\ContactMessageData;
use App\Enums\ContactMessageStatusEnum;
use App\Enums\ContactMessageTypeEnum;
use App\Models\ContactMessage;
use App\Repositories\Contracts\ContactMessageRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ContactMessageService
{
    public function __construct(
        private readonly ContactMessageRepositoryInterface $contactMessageRepository,
    ) {}

    /**
     * Paginate contact messages with optional status/type/search filters.
     *
     * @param  array<string, mixed>  $filters
     */
    public function paginateFiltered(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        return $this->contactMessageRepository->paginateFiltered($perPage, $filters);
    }

    /**
     * Build a filtered Eloquent query for Admin Yajra DataTables.
     *
     * @param  array{type?: string|null, status?: string|null, search?: string|null}  $filters
     * @return Builder<ContactMessage>
     */
    public function getAdminDataTableQuery(array $filters = []): Builder
    {
        /** @var Builder<ContactMessage> $query */
        $query = $this->contactMessageRepository->adminQuery();

        if (! empty($filters['type'])) {
            $typeEnum = ContactMessageTypeEnum::tryFrom((string) $filters['type']);
            if ($typeEnum !== null) {
                $query->ofType($typeEnum);
            }
        }

        if (! empty($filters['status'])) {
            $statusEnum = ContactMessageStatusEnum::tryFrom((string) $filters['status']);
            if ($statusEnum !== null) {
                $query->withStatus($statusEnum);
            }
        }

        if (! empty($filters['search'])) {
            $search = (string) $filters['search'];
            $query->where(static function (Builder $builder) use ($search): void {
                $builder->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        return $query;
    }

    /**
     * Get the latest contact messages for the Admin Dashboard widget.
     *
     * @return Collection<int, ContactMessage>
     */
    public function getLatest(int $limit = 5): Collection
    {
        return $this->contactMessageRepository->getLatest($limit);
    }

    /**
     * Count unread/new contact messages.
     */
    public function countUnread(): int
    {
        return $this->contactMessageRepository->countUnread();
    }

    /**
     * Get message counts grouped by ContactMessageStatusEnum value.
     *
     * @return array<string, int>
     */
    public function countByStatus(): array
    {
        return $this->contactMessageRepository->countByStatus();
    }

    /**
     * Store a new public contact message or project inquiry from a ContactMessageData DTO.
     */
    public function submit(ContactMessageData $dto): ContactMessage
    {
        return DB::transaction(function () use ($dto): ContactMessage {
            $sortOrder = $this->contactMessageRepository->nextSortOrder();

            /** @var ContactMessage $message */
            $message = $this->contactMessageRepository->create($dto->toAttributes($sortOrder));

            return $message;
        });
    }

    /**
     * Alias for submit() to keep uniform service naming across modules.
     */
    public function create(ContactMessageData $dto): ContactMessage
    {
        return $this->submit($dto);
    }

    /**
     * Mark a contact message as read if it is currently unread.
     */
    public function markAsRead(ContactMessage $message): ContactMessage
    {
        return DB::transaction(
            fn (): ContactMessage => $this->contactMessageRepository->markAsRead($message)
        );
    }

    /**
     * Update the status and/or admin notes of a contact message.
     */
    public function updateStatus(
        ContactMessage $message,
        ContactMessageStatusEnum $status,
        ?string $adminNotes = null,
    ): ContactMessage {
        return DB::transaction(function () use ($message, $status, $adminNotes): ContactMessage {
            $attributes = [
                'status' => $status->value,
            ];

            if ($adminNotes !== null) {
                $attributes['admin_notes'] = $adminNotes;
            }

            if ($status !== ContactMessageStatusEnum::New && $message->read_at === null) {
                $attributes['read_at'] = now();
            }

            /** @var ContactMessage $updated */
            $updated = $this->contactMessageRepository->update($message, $attributes);

            return $updated;
        });
    }

    /**
     * Delete a contact message.
     */
    public function delete(ContactMessage $message): bool
    {
        return DB::transaction(
            fn (): bool => $this->contactMessageRepository->delete($message)
        );
    }

    /**
     * Reorder contact messages.
     *
     * @param  array<int, int|array{id: int, sort_order?: int}>  $items
     */
    public function reorder(array $items): void
    {
        DB::transaction(function () use ($items): void {
            $this->contactMessageRepository->reorder($items);
        });
    }
}
