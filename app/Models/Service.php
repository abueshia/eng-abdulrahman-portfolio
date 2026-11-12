<?php

/**
 * Service Model
 *
 * Represents a professional software engineering service offered by
 * Eng. Abdelrahman Abu Aishah (Backend Architecture, React.js SPAs, APIs, etc.).
 */

declare(strict_types=1);

namespace App\Models;

use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Service extends Model implements HasMedia
{
    use HandleUploadFile;
    use HasFactory;
    use HasTranslations;
    use InteractsWithMedia;

    /**
     * The table associated with the model.
     */
    protected $table = 'services';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'subtitle',
        'short_description',
        'description',
        'features',
        'icon',
        'is_featured',
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
        'subtitle',
        'short_description',
        'description',
        'features',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Register media collections for service icon/cover image.
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('services')->singleFile();
    }

    /**
     * Scope a query to only include active services.
     *
     * @param  Builder<Service>  $query
     * @return Builder<Service>
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include featured services.
     *
     * @param  Builder<Service>  $query
     * @return Builder<Service>
     */
    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope a query to order services by sort_order.
     *
     * @param  Builder<Service>  $query
     * @return Builder<Service>
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('id', 'asc');
    }
}
