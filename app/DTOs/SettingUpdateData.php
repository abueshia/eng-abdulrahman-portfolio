<?php

/**
 * SettingUpdateData DTO
 *
 * Immutable Data Transfer Object carrying validated setting key-value pairs
 * and uploaded files from the Admin Settings update request to SettingService.
 */

declare(strict_types=1);

namespace App\DTOs;

use Illuminate\Http\UploadedFile;

readonly class SettingUpdateData
{
    /**
     * @param  array<string, mixed>  $settings  Key-value map of submitted setting values (translatable arrays, strings, booleans).
     * @param  array<string, UploadedFile>  $files  Key-value map of uploaded files (logo, favicon, profile_image, cv_file_ar, cv_file_en, etc.).
     * @param  string|null  $activeGroup  Optional active tab group identifier.
     */
    public function __construct(
        public array $settings = [],
        public array $files = [],
        public ?string $activeGroup = null,
    ) {}

    /**
     * Create a SettingUpdateData instance from validated request payload and uploaded files.
     *
     * @param  array<string, mixed>  $validated
     * @param  array<string, UploadedFile>  $uploadedFiles
     */
    public static function fromRequest(array $validated, array $uploadedFiles = []): self
    {
        $settings = is_array($validated['settings'] ?? null)
            ? $validated['settings']
            : [];

        $activeGroup = isset($validated['active_group'])
            ? (string) $validated['active_group']
            : null;

        return new self(
            settings: $settings,
            files: $uploadedFiles,
            activeGroup: $activeGroup,
        );
    }
}

