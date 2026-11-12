<?php

/**
 * Project Model
 *
 * Represents a software engineering project or case study in Eng. Abdelrahman Abu Aishah's
 * portfolio, including architectural challenge, technical solution, and measurable results.
 */

declare(strict_types=1);

namespace App\Models;

use App\Enums\ProjectStatusEnum;
use App\Enums\ProjectTypeEnum;
use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Project extends Model implements HasMedia
{
    use HandleUploadFile;
    use HasFactory;
    use HasTranslations;
    use InteractsWithMedia;

    /**
     * The table associated with the model.
     */
    protected $table = 'projects';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'subtitle',
        'short_description',
        'description',
        'challenge',
        'solution',
        'results',
        'client_name',
        'role_title',
        'project_type',
        'status',
        'live_url',
        'repo_url',
        'video_url',
        'completed_at',
        'duration',
        'metrics',
        'meta_title',
        'meta_description',
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
        'challenge',
        'solution',
        'results',
        'client_name',
        'role_title',
        'duration',
        'meta_title',
        'meta_description',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'project_type' => ProjectTypeEnum::class,
        'status' => ProjectStatusEnum::class,
        'completed_at' => 'date',
        'metrics' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Register media collections for project cover and gallery screenshots.
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('projects')->singleFile();
        $this->addMediaCollection('projects_gallery');
    }

    /**
     * Get the primary category of the project.
     *
     * @return BelongsTo<Category, Project>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Get the technologies used in this project.
     *
     * @return BelongsToMany<Technology>
     */
    public function technologies(): BelongsToMany
    {
        return $this->belongsToMany(Technology::class, 'project_technology')
            ->withPivot(['role_in_project', 'sort_order'])
            ->withTimestamps()
            ->orderByPivot('sort_order');
    }

    /**
     * Get client testimonials linked to this project.
     *
     * @return HasMany<Testimonial>
     */
    public function testimonials(): HasMany
    {
        return $this->hasMany(Testimonial::class, 'project_id');
    }

    /**
     * Scope a query to only include active projects.
     *
     * @param  Builder<Project>  $query
     * @return Builder<Project>
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include published and active projects.
     *
     * @param  Builder<Project>  $query
     * @return Builder<Project>
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_active', true)
            ->where('status', ProjectStatusEnum::Published->value);
    }

    /**
     * Scope a query to only include featured projects.
     *
     * @param  Builder<Project>  $query
     * @return Builder<Project>
     */
    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope a query to filter projects by ProjectTypeEnum.
     *
     * @param  Builder<Project>  $query
     * @return Builder<Project>
     */
    public function scopeOfType(Builder $query, ProjectTypeEnum|string $type): Builder
    {
        $value = $type instanceof ProjectTypeEnum ? $type->value : $type;

        return $query->where('project_type', $value);
    }

    /**
     * Scope a query to order projects by sort_order and completion date.
     *
     * @param  Builder<Project>  $query
     * @return Builder<Project>
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order', 'asc')->orderByDesc('completed_at')->orderByDesc('id');
    }
}
