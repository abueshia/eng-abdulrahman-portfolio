<?php

/**
 * EloquentContactMessageRepository
 *
 * Eloquent implementation of ContactMessageRepositoryInterface.
 */

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Enums\ContactMessageStatusEnum;
use App\Enums\ContactMessageTypeEnum;
use App\Models\ContactMessage;
use App\Repositories\Contracts\ContactMessageRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class EloquentContactMessageRepository extends BaseRepository implements ContactMessageRepositoryInterface
{
    /**
     * Initialize the repository with the ContactMessage model.
     */
    public function __construct(ContactMessage $model)
    {
        parent::__construct($model);
    }

    /**
     * {@inheritDoc}
     */
    public function paginateFiltered(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        $query = $this->query();

        $this->applySearch(
            $query,
            $filters['search'] ?? null,
            [],
            ['name', 'email', 'phone', 'subject', 'message']
        );

        return $query
            ->when(
                ! empty($filters['type']),
                fn (Builder $builder) => $builder->ofType(ContactMessageTypeEnum::from((string) $filters['type']))
            )
            ->when(
                ! empty($filters['status']),
                fn (Builder $builder) => $builder->withStatus(ContactMessageStatusEnum::from((string) $filters['status']))
            )
            ->ordered()
            ->paginate($perPage);
    }

    /**
     * {@inheritDoc}
     */
    public function getLatest(int $limit = 5): Collection
    {
        /** @var Collection<int, ContactMessage> $messages */
        $messages = $this->query()->ordered()->limit($limit)->get();

        return $messages;
    }

    /**
     * {@inheritDoc}
     */
    public function getByStatus(ContactMessageStatusEnum $status): Collection
    {
        /** @var Collection<int, ContactMessage> $messages */
        $messages = $this->query()->withStatus($status)->ordered()->get();

        return $messages;
    }

    /**
     * {@inheritDoc}
     */
    public function countUnread(): int
    {
        return $this->query()->unread()->count();
    }

    /**
     * {@inheritDoc}
     */
    public function countByStatus(): array
    {
        /** @var array<string, int> $counts */
        $counts = $this->query()
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status')
            ->map(static fn (mixed $total): int => (int) $total)
            ->all();

        $result = [];

        foreach (ContactMessageStatusEnum::cases() as $status) {
            $result[$status->value] = $counts[$status->value] ?? 0;
        }

        return $result;
    }

    /**
     * {@inheritDoc}
     */
    public function markAsRead(ContactMessage $message): ContactMessage
    {
        if ($message->read_at === null) {
            $message->read_at = now();
        }

        if ($message->status === ContactMessageStatusEnum::New) {
            $message->status = ContactMessageStatusEnum::Read;
        }

        $message->save();

        return $message;
    }
}
