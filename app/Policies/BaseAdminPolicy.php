<?php

/**
 * BaseAdminPolicy
 *
 * Abstract base policy for Admin CMS modules backed by Spatie Permission
 * on the 'admin' authentication guard.
 */

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

abstract class BaseAdminPolicy
{
    /**
     * Get the Spatie permission module prefix (e.g., 'projects', 'technologies').
     */
    abstract protected function permissionPrefix(): string;

    /**
     * Determine whether the admin user can view the module index list.
     */
    public function viewAny(User $user): bool
    {
        return $this->hasModulePermission($user, 'view_all');
    }

    /**
     * Determine whether the admin user can view a specific record.
     */
    public function view(User $user, ?Model $model = null): bool
    {
        return $this->hasModulePermission($user, 'view_details')
            || $this->hasModulePermission($user, 'view_all');
    }

    /**
     * Determine whether the admin user can create a new record.
     */
    public function create(User $user): bool
    {
        return $this->hasModulePermission($user, 'create');
    }

    /**
     * Determine whether the admin user can update an existing record.
     */
    public function update(User $user, ?Model $model = null): bool
    {
        return $this->hasModulePermission($user, 'edit');
    }

    /**
     * Determine whether the admin user can delete a record.
     */
    public function delete(User $user, ?Model $model = null): bool
    {
        return $this->hasModulePermission($user, 'delete');
    }

    /**
     * Determine whether the admin user can reorder records.
     */
    public function reorder(User $user): bool
    {
        return $this->hasModulePermission($user, 'sort');
    }

    /**
     * Check if the user is an active admin and holds the given module action permission on the 'admin' guard.
     */
    protected function hasModulePermission(User $user, string $action): bool
    {
        if (! $user->isAdmin()) {
            return false;
        }

        $permissionName = "{$this->permissionPrefix()}.{$action}";

        return $user->checkPermissionTo($permissionName, 'admin');
    }
}

