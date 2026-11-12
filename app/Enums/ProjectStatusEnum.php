<?php

/**
 * ProjectStatusEnum
 *
 * Represents the publication lifecycle state of a portfolio project.
 */

declare(strict_types=1);

namespace App\Enums;

enum ProjectStatusEnum: string
{
    case Draft = 'draft';
    case Published = 'published';
    case Archived = 'archived';

    /**
     * Get the localized display label for the status.
     */
    public function label(): string
    {
        return (string) __("enums.project_status.{$this->value}");
    }

    /**
     * Get the UI badge color class for the status.
     */
    public function color(): string
    {
        return match ($this) {
            self::Draft => 'warning',
            self::Published => 'success',
            self::Archived => 'secondary',
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
