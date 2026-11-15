<?php

/**
 * SettingPolicy
 *
 * Authorization policy for Setting model actions on the 'admin' guard.
 */

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class SettingPolicy extends BaseAdminPolicy
{
    protected function permissionPrefix(): string
    {
        return 'mainSetting';
    }

    public function viewAny(User $user): bool
    {
        if (! $user->isAdmin()) {
            return false;
        }

        return $user->checkPermissionTo('all_settings.view_all', 'admin')
            || $user->checkPermissionTo('mainSetting.view_details', 'admin')
            || $user->checkPermissionTo('mainSetting.edit', 'admin');
    }

    public function view(User $user, ?Model $model = null): bool
    {
        return $this->viewAny($user);
    }

    public function update(User $user, ?Model $model = null): bool
    {
        if (! $user->isAdmin()) {
            return false;
        }

        return $user->checkPermissionTo('mainSetting.edit', 'admin');
    }
}
