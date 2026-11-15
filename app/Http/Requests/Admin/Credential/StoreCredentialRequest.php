<?php

/**
 * StoreCredentialRequest
 *
 * Validates creation of a new academic degree, certification, course, or award.
 */

declare(strict_types=1);

namespace App\Http\Requests\Admin\Credential;

use App\Enums\CredentialTypeEnum;
use App\Http\Requests\BasePortfolioFormRequest;
use Illuminate\Validation\Rule;

class StoreCredentialRequest extends BasePortfolioFormRequest
{
    public function authorize(): bool
    {
        return $this->authorizeAdminPermission('credentials.create');
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'array'],
            'title.ar' => ['required', 'string', 'max:255'],
            'title.en' => ['required', 'string', 'max:255'],
            'organization' => ['required', 'array'],
            'organization.ar' => ['required', 'string', 'max:255'],
            'organization.en' => ['required', 'string', 'max:255'],
            'type' => ['required', Rule::enum(CredentialTypeEnum::class)],
            'issued_at' => ['required', 'date'],
            'expires_at' => ['nullable', 'date', 'after_or_equal:issued_at'],
            'credential_id' => ['nullable', 'string', 'max:150'],
            'credential_url' => ['nullable', 'url', 'max:500'],
            'description' => ['nullable', 'array'],
            'description.ar' => ['nullable', 'string'],
            'description.en' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,svg,pdf', 'max:4096'],
        ];
    }
}
