<?php

/**
 * FaqPolicy
 *
 * Authorization policy for Faq model actions on the 'admin' guard.
 */

declare(strict_types=1);

namespace App\Policies;

class FaqPolicy extends BaseAdminPolicy
{
    protected function permissionPrefix(): string
    {
        return 'faqs';
    }
}
