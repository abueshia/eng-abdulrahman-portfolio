<?php

/**
 * SettingGroupEnum
 *
 * Groups dynamic portfolio settings into logical dashboard tabs and API sections:
 * General, Hero & CV, About, Contact & Social, SEO, Sections Visibility, and CTA.
 */

declare(strict_types=1);

namespace App\Enums;

enum SettingGroupEnum: string
{
    case General = 'general';
    case Hero = 'hero';
    case About = 'about';
    case Contact = 'contact';
    case Social = 'social';
    case Seo = 'seo';
    case SectionsVisibility = 'sections_visibility';
    case Cta = 'cta';

    /**
     * Get the localized display label for the setting group.
     */
    public function label(): string
    {
        return (string) __("enums.setting_group.{$this->value}");
    }

    /**
     * Get the UI badge color class for the setting group.
     */
    public function color(): string
    {
        return match ($this) {
            self::General => 'primary',
            self::Hero => 'dark',
            self::About => 'info',
            self::Contact, self::Social => 'success',
            self::Seo => 'danger',
            self::SectionsVisibility => 'warning',
            self::Cta => 'primary',
        };
    }

    /**
     * Get the FontAwesome / Keenicons icon class for dashboard tabs.
     */
    public function icon(): string
    {
        return match ($this) {
            self::General => 'fa-solid fa-sliders',
            self::Hero => 'fa-solid fa-terminal',
            self::About => 'fa-solid fa-user-tie',
            self::Contact, self::Social => 'fa-solid fa-address-Book',
            self::Seo => 'fa-solid fa-magnifying-glass-chart',
            self::SectionsVisibility => 'fa-solid fa-eye',
            self::Cta => 'fa-solid fa-bullhorn',
        };
    }

    /**
     * Return the ordered groups displayed as tabs on the Admin Settings page.
     *
     * @return array<int, self>
     */
    public static function dashboardTabs(): array
    {
        return [
            self::General,
            self::Hero,
            self::About,
            self::Contact,
            self::Seo,
            self::SectionsVisibility,
            self::Cta,
        ];
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
