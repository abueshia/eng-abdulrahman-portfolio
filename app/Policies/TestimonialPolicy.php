<?php

/**
 * TestimonialPolicy
 *
 * Authorization policy for Testimonial model actions on the 'admin' guard.
 */

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;

class TestimonialPolicy extends BaseAdminPolicy
{
    protected function permissionPrefix(): string
    {
        return 'testimonial';
    }

    /**
     * Support both 'testimonial.*' (seeded in RoleSeeder) and 'testimonials.*' permission prefixes.
     */
    protected function hasModulePermission(User $user, string $action): bool
    {
        if (! $user->isAdmin()) {
            return false;
        }

        return $user->checkPermissionTo("testimonial.{$action}", 'admin')
            || $user->checkPermissionTo("testimonials.{$action}", 'admin');
    }
}

