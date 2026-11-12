<?php

/**
 * EmploymentTypeEnum
 *
 * Defines the engagement/contract type for professional work experience entries.
 */

declare(strict_types=1);

namespace App\Enums;

enum EmploymentTypeEnum: string
{
    case FullTime = 'full_time';
    case PartTime = 'part_time';
    case Contract = 'contract';
    case Freelance = 'freelance';
    case Remote = 'remote';

    /**
     * Get the localized display label for the employment type.
     */
    public function label(): string
    {
        return (string) __("enums.employment_type.{$this->value}");
    }

    /**
     * Get the UI badge color class for the employment type.
     */
    public function color(): string
    {
        return match ($this) {
            self::FullTime => 'primary',
            self::PartTime => 'info',
            self::Contract => 'warning',
            self::Freelance => 'success',
            self::Remote => 'dark',
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
