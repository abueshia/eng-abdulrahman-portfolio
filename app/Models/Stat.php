<?php

/**
 * Stat Model
 *
 * Represents a quantitative career metric (e.g., 4+ Years Experience, 35+ Delivered Projects).
 */

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Stat extends Model
{
    use HasFactory;
    use HasTranslations;

    /**
     * The table associated with the model.
     */
    protected $table = 'stats';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'label',
        'value',
        'prefix',
        'suffix',
        'icon',
        'is_active',
        'sort_order',
    ];

    /**
     * Translatable JSON attributes managed by Spatie Translatable.
     *
     * @var array<int, string>
     */
    public array $translatable = [
        'label',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Scope a query to only include active stats.
     *
     * @param  Builder<Stat>  $query
     * @return Builder<Stat>
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to order stats by sort_order.
     *
     * @param  Builder<Stat>  $query
     * @return Builder<Stat>
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('id', 'asc');
    }
}
