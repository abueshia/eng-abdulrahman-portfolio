<?php

/**
 * Experience Model
 *
 * Represents a professional work experience entry in Eng. Abdelrahman Abu Aishah's
 * software engineering career timeline.
 */

declare(strict_types=1);

namespace App\Models;

use App\Enums\EmploymentTypeEnum;
use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Experience extends Model implements HasMedia
{
    use HandleUploadFile;
    use HasFactory;
    use HasTranslations;
    use InteractsWithMedia;

    /**
     * The table associated with the model.
     */
    protected $table = 'experiences';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_name',
        'role_title',
        'employment_type',
        'location',
        'company_url',
        'start_date',
        'end_date',
        'is_current',
        'summary',
        'achievements',
        'is_active',
        'sort_order',
    ];

    /**
     * Translatable JSON attributes managed by Spatie Translatable.
     *
     * @var array<int, string>
     */
    public array $translatable = [
        'company_name',
        'role_title',
        'location',
        'summary',
        'achievements',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'employment_type' => EmploymentTypeEnum::class,
        'start_date' => 'date',
        'end_date' => 'date',
        'is_current' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Register media collections for company logo.
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('experiences')->singleFile();
    }

    /**
     * Get the technologies utilized during this work experience.
     *
     * @return BelongsToMany<Technology>
     */
    public function technologies(): BelongsToMany
    {
        return $this->belongsToMany(Technology::class, 'experience_technology')
            ->withTimestamps();
    }

    /**
     * Scope a query to only include active experience entries.
     *
     * @param  Builder<Experience>  $query
     * @return Builder<Experience>
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to order experiences chronologically (current first, then by sort_order and start_date).
     *
     * @param  Builder<Experience>  $query
     * @return Builder<Experience>
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order', 'asc')
            ->orderByDesc('is_current')
            ->orderByDesc('start_date');
    }
}
