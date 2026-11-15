<?php

/**
 * FaqViewModel
 *
 * Supplies form state and route action/method to the Admin FAQ create/edit form view.
 */

declare(strict_types=1);

namespace App\ViewModels;

use App\Models\Faq;
use Spatie\ViewModels\ViewModel;

class FaqViewModel extends ViewModel
{
    public Faq $faq;

    public function __construct(?Faq $faq = null)
    {
        $this->faq = $faq ?? new Faq([
            'category' => 'general',
            'is_active' => true,
        ]);
    }

    public function action(): string
    {
        return $this->faq->exists
            ? route('admin.faq.update', ['faq' => $this->faq->id])
            : route('admin.faq.store');
    }

    public function method(): string
    {
        return $this->faq->exists ? 'PUT' : 'POST';
    }
}

