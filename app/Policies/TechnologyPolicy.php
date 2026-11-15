<?php

/**
 * TechnologyPolicy
 *
 * Authorization policy for Technology model actions on the 'admin' guard.
 */

declare(strict_types=1);

namespace App\Policies;

class TechnologyPolicy extends BaseAdminPolicy
{
    protected function permissionPrefix(): string
    {
        return 'technologies';
    }
}
