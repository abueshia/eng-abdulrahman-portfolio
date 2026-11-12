<?php

/**
 * ContactMessage Model
 *
 * Represents a contact message, project inquiry, job opportunity, or technical
 * consultation submitted via the public portfolio website or REST API.
 */

declare(strict_types=1);

namespace App\Models;

use App\Enums\ContactMessageStatusEnum;
use App\Enums\ContactMessageTypeEnum;
use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ContactMessage extends Model implements HasMedia
{
    use HandleUploadFile;
    use HasFactory;
    use InteractsWithMedia;

    /**
     * The table associated with the model.
     */
    protected $table = 'contact_messages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'service',
        'budget_range',
        'timeline',
        'message',
        'type',
        'status',
        'admin_notes',
        'ip_address',
        'user_agent',
        'read_at',
        'sort_order',
        'lft',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'type' => ContactMessageTypeEnum::class,
        'status' => ContactMessageStatusEnum::class,
        'read_at' => 'datetime',
        'sort_order' => 'integer',
    ];

    /**
     * Scope a query to filter messages by ContactMessageTypeEnum.
     *
     * @param  Builder<ContactMessage>  $query
     * @return Builder<ContactMessage>
     */
    public function scopeOfType(Builder $query, ContactMessageTypeEnum|string $type): Builder
    {
        $value = $type instanceof ContactMessageTypeEnum ? $type->value : $type;

        return $query->where('type', $value);
    }

    /**
     * Scope a query to filter messages by ContactMessageStatusEnum.
     *
     * @param  Builder<ContactMessage>  $query
     * @return Builder<ContactMessage>
     */
    public function scopeWithStatus(Builder $query, ContactMessageStatusEnum|string $status): Builder
    {
        $value = $status instanceof ContactMessageStatusEnum ? $status->value : $status;

        return $query->where('status', $value);
    }

    /**
     * Scope a query to only include unread/new messages.
     *
     * @param  Builder<ContactMessage>  $query
     * @return Builder<ContactMessage>
     */
    public function scopeUnread(Builder $query): Builder
    {
        return $query->where('status', ContactMessageStatusEnum::New->value);
    }

    /**
     * Scope a query to order messages newest first.
     *
     * @param  Builder<ContactMessage>  $query
     * @return Builder<ContactMessage>
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderByDesc('created_at')->orderByDesc('id');
    }
}
