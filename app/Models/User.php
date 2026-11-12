<?php

/**
 * User Model
 *
 * Represents an administrator account in the Portfolio CMS on the 'admin' guard.
 */

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasRoles;
    use Notifiable;

    /**
     * The table associated with the model.
     */
    protected $table = 'users';

    /**
     * The Spatie Permission guard name for admin roles and permissions.
     */
    protected string $guard_name = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'l_name',
        'username',
        'email',
        'phone',
        'type',
        'is_admin',
        'password',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean',
    ];

    /**
     * Scope a query to only include administrator accounts.
     *
     * @param  Builder<User>  $query
     * @return Builder<User>
     */
    public function scopeUsers(Builder $query): Builder
    {
        return $query->where('is_admin', true);
    }

    /**
     * Determine whether the user has administrator privileges.
     */
    public function isAdmin(): bool
    {
        return (bool) $this->is_admin;
    }

    /**
     * Determine whether the user is a standard non-admin user.
     */
    public function isUser(): bool
    {
        return ! $this->isAdmin();
    }
}
