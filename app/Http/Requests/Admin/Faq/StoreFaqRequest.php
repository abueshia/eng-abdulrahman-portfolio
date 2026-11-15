<?php

/**
 * StoreFaqRequest
 *
 * Validates creation of a new bilingual Frequently Asked Question.
 */

declare(strict_types=1);

namespace App\Http\Requests\Admin\Faq;

use App\Http\Requests\BasePortfolioFormRequest;

class StoreFaqRequest extends BasePortfolioFormRequest
{
    public function authorize(): bool
    {
        return $this->authorizeAdminPermission('faqs.create');
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'question' => ['required', 'array'],
            'question.ar' => ['required', 'string', 'max:500'],
            'question.en' => ['required', 'string', 'max:500'],
            'answer' => ['required', 'array'],
            'answer.ar' => ['required', 'string'],
            'answer.en' => ['required', 'string'],
            'category' => ['nullable', 'string', 'max:120'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
