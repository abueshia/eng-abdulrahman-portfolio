<?php

/**
 * BasePortfolioFormRequest
 *
 * Abstract base FormRequest providing localized (Arabic & English) validation
 * messages, attribute labels, and admin guard permission checks.
 */

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

abstract class BasePortfolioFormRequest extends FormRequest
{
    /**
     * Check whether the authenticated admin user holds a specific Spatie permission.
     */
    protected function authorizeAdminPermission(string $permission): bool
    {
        /** @var User|null $user */
        $user = $this->user('admin') ?? $this->user();

        if (! $user instanceof User || ! $user->isAdmin()) {
            return false;
        }

        return $user->checkPermissionTo($permission, 'admin');
    }

    /**
     * Custom localized validation error messages (Arabic & English).
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            '*.required' => __('portfolio_validation.messages.required'),
            '*.ar.required' => __('portfolio_validation.messages.required_ar'),
            '*.en.required' => __('portfolio_validation.messages.required_en'),
            '*.string' => __('portfolio_validation.messages.string'),
            '*.array' => __('portfolio_validation.messages.array'),
            '*.integer' => __('portfolio_validation.messages.integer'),
            '*.numeric' => __('portfolio_validation.messages.numeric'),
            '*.boolean' => __('portfolio_validation.messages.boolean'),
            '*.email' => __('portfolio_validation.messages.email'),
            '*.url' => __('portfolio_validation.messages.url'),
            '*.date' => __('portfolio_validation.messages.date'),
            '*.after_or_equal' => __('portfolio_validation.messages.after_or_equal'),
            '*.exists' => __('portfolio_validation.messages.exists'),
            '*.unique' => __('portfolio_validation.messages.unique'),
            '*.enum' => __('portfolio_validation.messages.enum'),
            '*.image' => __('portfolio_validation.messages.image'),
            '*.mimes' => __('portfolio_validation.messages.mimes'),
            '*.max.string' => __('portfolio_validation.messages.max_string'),
            '*.max.file' => __('portfolio_validation.messages.max_file'),
            '*.min.numeric' => __('portfolio_validation.messages.min_numeric'),
            '*.max.numeric' => __('portfolio_validation.messages.max_numeric'),
        ];
    }

    /**
     * Custom localized validation attribute names (Arabic & English).
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        /** @var array<string, string> $attributes */
        $attributes = trans('portfolio_validation.attributes');

        return is_array($attributes) ? $attributes : [];
    }
}

