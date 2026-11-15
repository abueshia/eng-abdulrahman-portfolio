<?php

/**
 * CategoryPolicy
 *
 * Authorization policy for Category model actions on the 'admin' guard.
 */

declare(strict_types=1);

namespace App\Policies;

class CategoryPolicy extends BaseAdminPolicy
{
    protected function permissionPrefix(): string
    {
        return 'categories';
    }
}

