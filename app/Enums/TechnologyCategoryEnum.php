<?php

/**
 * TechnologyCategoryEnum
 *
 * Groups technical skills and tools by software engineering domain.
 */

declare(strict_types=1);

namespace App\Enums;

enum TechnologyCategoryEnum: string
{
    case Backend = 'backend';
    case Frontend = 'frontend';
    case Database = 'database';
    case Devops = 'devops';
    case Architecture = 'architecture';
    case Testing = 'testing';
    case Tools = 'tools';

    /**
     * Get the localized display label for the technology category.
     */
    public function label(): string
    {
        return (string) __("enums.technology_category.{$this->value}");
    }

    /**
     * Get the UI badge color class for the technology category.
     */
    public function color(): string
    {
        return match ($this) {
            self::Backend => 'primary',
            self::Frontend => 'info',
            self::Database => 'success',
            self::Devops => 'warning',
            self::Architecture => 'dark',
            self::Testing => 'danger',
            self::Tools => 'secondary',
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
