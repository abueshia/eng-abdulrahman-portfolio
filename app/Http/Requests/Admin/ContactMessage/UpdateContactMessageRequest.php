<?php

/**
 * UpdateContactMessageRequest
 *
 * Validates updating the status and/or admin notes of a contact message in the Admin CMS.
 */

declare(strict_types=1);

namespace App\Http\Requests\Admin\ContactMessage;

use App\Enums\ContactMessageStatusEnum;
use App\Http\Requests\BasePortfolioFormRequest;
use Illuminate\Validation\Rule;

class UpdateContactMessageRequest extends BasePortfolioFormRequest
{
    public function authorize(): bool
    {
        return $this->authorizeAdminPermission('messages.edit');
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'status' => ['required', Rule::enum(ContactMessageStatusEnum::class)],
            'admin_notes' => ['nullable', 'string', 'max:5000'],
        ];
    }
}

