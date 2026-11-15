<?php

/**
 * StatViewModel
 *
 * Supplies form state and route action/method to the Admin Stat create/edit form view.
 */

declare(strict_types=1);

namespace App\ViewModels;

use App\Models\Stat;
use Spatie\ViewModels\ViewModel;

class StatViewModel extends ViewModel
{
    public Stat $stat;

    public function __construct(?Stat $stat = null)
    {
        $this->stat = $stat ?? new Stat([
            'is_active' => true,
        ]);
    }

    public function action(): string
    {
        return $this->stat->exists
            ? route('admin.stat.update', ['stat' => $this->stat->id])
            : route('admin.stat.store');
    }

    public function method(): string
    {
        return $this->stat->exists ? 'PUT' : 'POST';
    }
}

