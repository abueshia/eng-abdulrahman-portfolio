<?php

/**
 * PortfolioLocale
 *
 * Single source of truth for the content locales supported by translatable
 * portfolio attributes (Spatie Translatable JSON columns).
 */

declare(strict_types=1);

namespace App\Support;

final class PortfolioLocale
{
    /**
     * Locales every translatable attribute must be authored in.
     *
     * @var array<int, string>
     */
    public const SUPPORTED = ['ar', 'en'];

    /**
     * Locale used as the source for slug generation and as the final content fallback.
     */
    public const FALLBACK = 'en';
}
