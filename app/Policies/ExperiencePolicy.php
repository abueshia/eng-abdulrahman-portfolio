<?php

/**
 * ExperiencePolicy
 *
 * Authorization policy for Experience model actions on the 'admin' guard.
 */

declare(strict_types=1);

namespace App\Policies;

class ExperiencePolicy extends BaseAdminPolicy
{
    protected function permissionPrefix(): string
    {
        return 'experiences';
    }
}
