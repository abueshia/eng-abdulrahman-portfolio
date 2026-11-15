<?php

/**
 * ContactMessagePolicy
 *
 * Authorization policy for ContactMessage model actions on the 'admin' guard.
 * Note: Public submission via web/API is open to guests, while viewing,
 * updating status/notes, and deleting require 'messages.*' admin permissions.
 */

declare(strict_types=1);

namespace App\Policies;

class ContactMessagePolicy extends BaseAdminPolicy
{
    protected function permissionPrefix(): string
    {
        return 'messages';
    }
}

