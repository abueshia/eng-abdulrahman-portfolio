<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    use HasApiTokens, HasFactory, Notifiable;


    protected $table = "users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'username',
        'l_name',
        'is_admin',
        'branche_id',
        'paintscategory_id',
        'user_id'
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
    ];

    public function scopeUsers($query)
    {
        return $query->where('is_admin', 1);  
    }

  public function isAdmin()
{
    return $this->is_admin == 1;
}

public function isUser()
{
    return $this->is_admin == 0;
}

    public function programmebooking()
    {
        return $this->hasMany(ProgrammeBooking::class, 'user_id', 'id');
    }


    public function Branches()
    {
        return $this->belongsTo(Branche::class, 'branche_id', 'id');
    }

    public function notifications()
    {
        return $this->belongsTo(Notification::class, 'user_id', 'id');
    }

 

}
