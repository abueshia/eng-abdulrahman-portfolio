<?php

/**
 * StoreStatRequest
 *
 * Validates creation of a new quantitative portfolio statistic.
 */

declare(strict_types=1);

namespace App\Http\Requests\Admin\Stat;

use App\Http\Requests\BasePortfolioFormRequest;

class StoreStatRequest extends BasePortfolioFormRequest
{
    public function authorize(): bool
    {
        return $this->authorizeAdminPermission('stats.create');
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'label' => ['required', 'array'],
            'label.ar' => ['required', 'string', 'max:255'],
            'label.en' => ['required', 'string', 'max:255'],
            'value' => ['required', 'string', 'max:60'],
            'prefix' => ['nullable', 'string', 'max:20'],
            'suffix' => ['nullable', 'string', 'max:20'],
            'icon' => ['nullable', 'string', 'max:150'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
