<?php

/**
 * CredentialPolicy
 *
 * Authorization policy for Credential model actions on the 'admin' guard.
 */

declare(strict_types=1);

namespace App\Policies;

class CredentialPolicy extends BaseAdminPolicy
{
    protected function permissionPrefix(): string
    {
        return 'credentials';
    }
}

