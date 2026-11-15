<?php

/**
 * ServicePolicy
 *
 * Authorization policy for Service model actions on the 'admin' guard.
 */

declare(strict_types=1);

namespace App\Policies;

class ServicePolicy extends BaseAdminPolicy
{
    protected function permissionPrefix(): string
    {
        return 'services';
    }
}
