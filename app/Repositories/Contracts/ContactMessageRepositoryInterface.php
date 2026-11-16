<?php

/**
 * ContactMessageRepositoryInterface
 *
 * Contract for storing and managing contact messages, project inquiries and job offers.
 */

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Enums\ContactMessageStatusEnum;
use App\Models\ContactMessage;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface ContactMessageRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Paginate messages with optional type, status and free-text filters (newest first).
     *
     * @param  array{type?: string|null, status?: string|null, search?: string|null}  $filters
     * @return LengthAwarePaginator<ContactMessage>
     */
    public function paginateFiltered(int $perPage = 15, array $filters = []): LengthAwarePaginator;

    /**
     * Get the latest messages (newest first).
     *
     * @return Collection<int, ContactMessage>
     */
    public function getLatest(int $limit = 5): Collection;

    /**
     * Get all messages having the given status.
     *
     * @return Collection<int, ContactMessage>
     */
    public function getByStatus(ContactMessageStatusEnum $status): Collection;

    /**
     * Count the unread messages.
     */
    public function countUnread(): int;

    /**
     * Count messages grouped by status value (every status is present, defaulting to 0).
     *
     * @return array<string, int>
     */
    public function countByStatus(): array;

    /**
     * Get monthly message counts for the last N months (oldest to newest).
     *
     * @return array{labels: array<int, string>, counts: array<int, int>, series: array<int, array{month: string, label: string, count: int}>}
     */
    public function countByLastMonths(int $months = 6): array;

    /**
     * Mark a message as read (sets `read_at` and moves status from `new` to `read`).
     */
    public function markAsRead(ContactMessage $message): ContactMessage;
}
