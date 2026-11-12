<?php

/**
 * SettingTypeEnum
 *
 * Defines the input/data type of each dynamic setting record.
 */

declare(strict_types=1);

namespace App\Enums;

enum SettingTypeEnum: string
{
    case Text = 'text';
    case Textarea = 'textarea';
    case RichText = 'rich_text';
    case Image = 'image';
    case File = 'file';
    case Url = 'url';
    case Email = 'email';
    case Boolean = 'boolean';
    case Json = 'json';

    /**
     * Get the localized display label for the setting type.
     */
    public function label(): string
    {
        return (string) __("enums.setting_type.{$this->value}");
    }

    /**
     * Get the UI badge color class for the setting type.
     */
    public function color(): string
    {
        return match ($this) {
            self::Text, self::Textarea => 'primary',
            self::RichText => 'info',
            self::Image, self::File => 'warning',
            self::Url, self::Email => 'success',
            self::Boolean => 'dark',
            self::Json => 'secondary',
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
