<?php

/**
 * Credential Model
 *
 * Represents an academic degree, professional certification, specialized course,
 * or award earned by Eng. Abdelrahman Abu Aishah.
 */

declare(strict_types=1);

namespace App\Models;

use App\Enums\CredentialTypeEnum;
use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Credential extends Model implements HasMedia
{
    use HandleUploadFile;
    use HasFactory;
    use HasTranslations;
    use InteractsWithMedia;

    /**
     * The table associated with the model.
     */
    protected $table = 'credentials';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'organization',
        'type',
        'issued_at',
        'expires_at',
        'credential_id',
        'credential_url',
        'description',
        'is_active',
        'sort_order',
    ];

    /**
     * Translatable JSON attributes managed by Spatie Translatable.
     *
     * @var array<int, string>
     */
    public array $translatable = [
        'title',
        'organization',
        'description',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'type' => CredentialTypeEnum::class,
        'issued_at' => 'date',
        'expires_at' => 'date',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Register media collections for certificate badge/document image.
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('credentials')->singleFile();
    }

    /**
     * Scope a query to only include active credentials.
     *
     * @param  Builder<Credential>  $query
     * @return Builder<Credential>
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to filter credentials by CredentialTypeEnum.
     *
     * @param  Builder<Credential>  $query
     * @return Builder<Credential>
     */
    public function scopeOfType(Builder $query, CredentialTypeEnum|string $type): Builder
    {
        $value = $type instanceof CredentialTypeEnum ? $type->value : $type;

        return $query->where('type', $value);
    }

    /**
     * Scope a query to order credentials by sort_order and issue date.
     *
     * @param  Builder<Credential>  $query
     * @return Builder<Credential>
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order', 'asc')->orderByDesc('issued_at');
    }
}
