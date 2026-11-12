<?php

/**
 * CredentialTypeEnum
 *
 * Categorizes academic degrees, professional certifications, courses, and awards.
 */

declare(strict_types=1);

namespace App\Enums;

enum CredentialTypeEnum: string
{
    case AcademicDegree = 'academic_degree';
    case ProfessionalCertificate = 'professional_certificate';
    case Course = 'course';
    case Award = 'award';

    /**
     * Get the localized display label for the credential type.
     */
    public function label(): string
    {
        return (string) __("enums.credential_type.{$this->value}");
    }

    /**
     * Get the UI badge color class for the credential type.
     */
    public function color(): string
    {
        return match ($this) {
            self::AcademicDegree => 'primary',
            self::ProfessionalCertificate => 'success',
            self::Course => 'info',
            self::Award => 'warning',
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
