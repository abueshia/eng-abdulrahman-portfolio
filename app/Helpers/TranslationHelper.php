<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Support\Facades\Lang;

class TranslationHelper
{
    /**
     * Translate a UI key from the specified translation file or fall back to a readable label.
     */
    public static function translate(string $key, string $file = 'all'): string
    {
        $translationKey = $file.'.'.$key;

        if (Lang::has($translationKey)) {
            return (string) __($translationKey);
        }

        return ucfirst(str_replace('_', ' ', self::remove_invalid_charcaters($key)));
    }

    /**
     * Strip invalid characters from a translation key fallback.
     */
    public static function remove_invalid_charcaters(string $str): string
    {
        return (string) str_ireplace(['\'', '"', ',', ';', '<', '>', '?'], ' ', $str);
    }
}
