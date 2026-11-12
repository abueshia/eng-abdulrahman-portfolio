<?php

/**
 * ProjectTypeEnum
 *
 * Classifies portfolio projects by their architectural domain and delivery type.
 */

declare(strict_types=1);

namespace App\Enums;

enum ProjectTypeEnum: string
{
    case WebApp = 'web_app';
    case Saas = 'saas';
    case ApiBackend = 'api_backend';
    case Ecommerce = 'ecommerce';
    case CmsDashboard = 'cms_dashboard';
    case FullStack = 'full_stack';

    /**
     * Get the localized display label for the project type.
     */
    public function label(): string
    {
        return (string) __("enums.project_type.{$this->value}");
    }

    /**
     * Get the UI badge color class for the project type.
     */
    public function color(): string
    {
        return match ($this) {
            self::WebApp => 'primary',
            self::Saas => 'info',
            self::ApiBackend => 'dark',
            self::Ecommerce => 'success',
            self::CmsDashboard => 'warning',
            self::FullStack => 'danger',
        };
    }

    /**
     * Get all enum backing values.
     *
     * @return array<int, string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get key-value pairs of enum values and localized labels.
     *
     * @return array<string, string>
     */
    public static function options(): array
    {
        $options = [];
        foreach (self::cases() as $case) {
            $options[$case->value] = $case->label();
        }

        return $options;
    }
}
