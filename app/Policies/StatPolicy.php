<?php

/**
 * StatPolicy
 *
 * Authorization policy for Stat model actions on the 'admin' guard.
 */

declare(strict_types=1);

namespace App\Policies;

class StatPolicy extends BaseAdminPolicy
{
    protected function permissionPrefix(): string
    {
        return 'stats';
    }
}
