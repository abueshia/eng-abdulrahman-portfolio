<?php

/**
 * ContactMessageTypeEnum
 *
 * Classifies incoming contact messages and project inquiries by intent.
 */

declare(strict_types=1);

namespace App\Enums;

enum ContactMessageTypeEnum: string
{
    case GeneralContact = 'general_contact';
    case ProjectInquiry = 'project_inquiry';
    case JobOffer = 'job_offer';
    case Consultation = 'consultation';

    /**
     * Get the localized display label for the message type.
     */
    public function label(): string
    {
        return (string) __("enums.contact_message_type.{$this->value}");
    }

    /**
     * Get the UI badge color class for the message type.
     */
    public function color(): string
    {
        return match ($this) {
            self::GeneralContact => 'info',
            self::ProjectInquiry => 'primary',
            self::JobOffer => 'success',
            self::Consultation => 'warning',
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
