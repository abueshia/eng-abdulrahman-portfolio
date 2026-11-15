<?php

/**
 * BlogPolicy
 *
 * Authorization policy for Blog model actions on the 'admin' guard.
 */

declare(strict_types=1);

namespace App\Policies;

class BlogPolicy extends BaseAdminPolicy
{
    protected function permissionPrefix(): string
    {
        return 'blogs';
    }
}
