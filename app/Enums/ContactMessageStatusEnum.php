<?php

/**
 * ContactMessageStatusEnum
 *
 * Tracks the workflow status of incoming contact messages in the admin dashboard.
 */

declare(strict_types=1);

namespace App\Enums;

enum ContactMessageStatusEnum: string
{
    case New = 'new';
    case Read = 'read';
    case InProgress = 'in_progress';
    case Replied = 'replied';
    case Archived = 'archived';

    /**
     * Get the localized display label for the message status.
     */
    public function label(): string
    {
        return (string) __("enums.contact_message_status.{$this->value}");
    }

    /**
     * Get the UI badge color class for the message status.
     */
    public function color(): string
    {
        return match ($this) {
            self::New => 'danger',
            self::Read => 'info',
            self::InProgress => 'warning',
            self::Replied => 'success',
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
