<?php

/**
 * Technology Model
 *
 * Represents a programming language, framework, database, or tool in the technical stack
 * (e.g., PHP 8.3, Laravel 10, React.js, MySQL, Redis, Docker).
 */

declare(strict_types=1);

namespace App\Models;

use App\Enums\TechnologyCategoryEnum;
use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Technology extends Model implements HasMedia
{
    use HandleUploadFile;
    use HasFactory;
    use HasTranslations;
    use InteractsWithMedia;

    /**
     * The table associated with the model.
     */
    protected $table = 'technologies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'category',
        'icon',
        'badge_color',
        'proficiency_percent',
        'years_of_experience',
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
        'name',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'category' => TechnologyCategoryEnum::class,
        'proficiency_percent' => 'integer',
        'years_of_experience' => 'float',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Register media collections for technology icon/logo.
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('technologies')->singleFile();
    }

    /**
     * Get the portfolio projects built with this technology.
     *
     * @return BelongsToMany<Project>
     */
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_technology')
            ->withPivot(['role_in_project', 'sort_order'])
            ->withTimestamps();
    }

    /**
     * Get the work experiences utilizing this technology.
     *
     * @return BelongsToMany<Experience>
     */
    public function experiences(): BelongsToMany
    {
        return $this->belongsToMany(Experience::class, 'experience_technology')
            ->withTimestamps();
    }

    /**
     * Scope a query to only include active technologies.
     *
     * @param  Builder<Technology>  $query
     * @return Builder<Technology>
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include featured technologies.
     *
     * @param  Builder<Technology>  $query
     * @return Builder<Technology>
     */
    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope a query to filter technologies by TechnologyCategoryEnum.
     *
     * @param  Builder<Technology>  $query
     * @return Builder<Technology>
     */
    public function scopeByCategory(Builder $query, TechnologyCategoryEnum|string $category): Builder
    {
        $value = $category instanceof TechnologyCategoryEnum ? $category->value : $category;

        return $query->where('category', $value);
    }

    /**
     * Scope a query to order technologies by sort_order.
     *
     * @param  Builder<Technology>  $query
     * @return Builder<Technology>
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('id', 'asc');
    }
}
