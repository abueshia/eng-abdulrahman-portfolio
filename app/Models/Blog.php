<?php

/**
 * Blog Model
 *
 * Represents a bilingual technical article or software engineering tutorial.
 */

declare(strict_types=1);

namespace App\Models;

use App\Enums\BlogStatusEnum;
use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Blog extends Model implements HasMedia
{
    use HandleUploadFile;
    use HasFactory;
    use HasTranslations;
    use InteractsWithMedia;

    /**
     * The table associated with the model.
     */
    protected $table = 'blogs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'short_description',
        'description',
        'meta_title',
        'meta_description',
        'meta_tags',
        'alt_text',
        'reading_time_minutes',
        'views_count',
        'status',
        'is_featured',
        'is_active',
        'published_at',
        'sort_order',
        'parent_id',
        'lft',
        'rgt',
        'depth',
    ];

    /**
     * Translatable JSON attributes managed by Spatie Translatable.
     *
     * @var array<int, string>
     */
    public array $translatable = [
        'name',
        'short_description',
        'description',
        'meta_title',
        'meta_description',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => BlogStatusEnum::class,
        'reading_time_minutes' => 'integer',
        'views_count' => 'integer',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'published_at' => 'datetime',
        'sort_order' => 'integer',
    ];

    /**
     * Register media collections for blog cover image.
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('blogs')->singleFile();
    }

    /**
     * Get the category that this technical article belongs to.
     *
     * @return BelongsTo<Category, Blog>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Legacy alias for category() relationship used by existing Blade templates.
     *
     * @return BelongsTo<Category, Blog>
     */
    public function categories(): BelongsTo
    {
        return $this->category();
    }

    /**
     * Scope a query to only include active articles.
     *
     * @param  Builder<Blog>  $query
     * @return Builder<Blog>
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include published and active articles.
     *
     * @param  Builder<Blog>  $query
     * @return Builder<Blog>
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_active', true)
            ->where('status', BlogStatusEnum::Published->value);
    }

    /**
     * Scope a query to only include featured articles.
     *
     * @param  Builder<Blog>  $query
     * @return Builder<Blog>
     */
    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope a query to order articles by sort_order and publication date.
     *
     * @param  Builder<Blog>  $query
     * @return Builder<Blog>
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order', 'asc')
            ->orderByDesc('published_at')
            ->orderByDesc('id');
    }
}
