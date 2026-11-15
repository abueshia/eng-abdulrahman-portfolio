<?php

/**
 * ProjectPolicy
 *
 * Authorization policy for Project model actions on the 'admin' guard.
 */

declare(strict_types=1);

namespace App\Policies;

class ProjectPolicy extends BaseAdminPolicy
{
    protected function permissionPrefix(): string
    {
        return 'projects';
    }
}
