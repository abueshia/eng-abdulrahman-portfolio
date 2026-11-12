<?php

/**
 * UpdateSettingRequest
 *
 * Validates dynamic portfolio settings and uploaded media files (logo, favicon,
 * profile_image, about_image, seo_og_image, cv_file_ar, cv_file_en).
 */

declare(strict_types=1);

namespace App\Http\Requests\Admin\Setting;

use App\DTOs\SettingUpdateData;
use App\Enums\SettingGroupEnum;
use App\Enums\SettingKeyEnum;
use App\Enums\SettingTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;

class UpdateSettingRequest extends FormRequest
{
    /**
     * Determine if the authenticated admin is authorized to update settings.
     */
    public function authorize(): bool
    {
        $user = $this->user('admin');

        return $user !== null && (
            $user->can('mainSetting.edit')
            || $user->can('all_settings.view_all')
        );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $rules = [
            'active_group' => ['nullable', 'string', Rule::in(SettingGroupEnum::values())],
            'settings' => ['nullable', 'array'],

            // Image uploads (Max 4MB)
            'files.logo' => ['nullable', 'file', 'mimes:jpeg,jpg,png,webp,svg', 'max:4096'],
            'files.favicon' => ['nullable', 'file', 'mimes:jpeg,jpg,png,webp,svg,ico', 'max:2048'],
            'files.profile_image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:4096'],
            'files.about_image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:4096'],
            'files.seo_og_image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:4096'],

            // Resume / CV PDF uploads (Max 10MB)
            'files.cv_file_ar' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'files.cv_file_en' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
        ];

        foreach (SettingKeyEnum::cases() as $settingKey) {
            if (in_array($settingKey->type(), [SettingTypeEnum::Image, SettingTypeEnum::File], true)) {
                continue;
            }

            if ($settingKey->isTranslatable()) {
                $rules["settings.{$settingKey->value}"] = ['nullable', 'array'];
                $rules["settings.{$settingKey->value}.ar"] = ['nullable', 'string'];
                $rules["settings.{$settingKey->value}.en"] = ['nullable', 'string'];

                continue;
            }

            $rules["settings.{$settingKey->value}"] = match ($settingKey->type()) {
                SettingTypeEnum::Email => ['nullable', 'email', 'max:255'],
                SettingTypeEnum::Url => ['nullable', 'url', 'max:255'],
                SettingTypeEnum::Boolean => ['nullable', 'in:0,1,true,false'],
                default => ['nullable', 'string'],
            };
        }

        return $rules;
    }

    /**
     * Get custom validation error messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'settings.contact_email.email' => __('Please provide a valid contact email address.'),
            'files.*.mimes' => __('The uploaded file format is not supported.'),
            'files.*.max' => __('The uploaded file size exceeds the maximum allowed limit.'),
        ];
    }

    /**
     * Convert the validated request payload and uploaded files into a SettingUpdateData DTO.
     */
    public function toDto(): SettingUpdateData
    {
        /** @var array<string, UploadedFile> $uploadedFiles */
        $uploadedFiles = [];

        $filesInput = $this->file('files', []);
        if (is_array($filesInput)) {
            foreach ($filesInput as $key => $file) {
                if ($file instanceof UploadedFile && SettingKeyEnum::tryFrom((string) $key) !== null) {
                    $uploadedFiles[(string) $key] = $file;
                }
            }
        }

        return SettingUpdateData::fromRequest(
            validated: $this->validated(),
            uploadedFiles: $uploadedFiles,
        );
    }
}
