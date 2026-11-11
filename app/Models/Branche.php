<?php

namespace App\Models;

use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Branche extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HandleUploadFile , HasTranslations;

    protected $table = 'branches'; 
    

    protected $fillable = ['name', 'address' , 'phone' , 'google_map' , 'city_id' , 'is_favorite'];

    protected $guarded = ['id'];

    public $translatable = ['name', 'address'];

    public function scopeOrdered($q)
    {
        return $q->orderBy('id', 'asc');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }


    public function users()
    {
        return $this->hasMany(User::class, 'branche_id', 'id');
    }


    
    // العلاقة مع العروض (many-to-many)
    public function offers()
    {
        return $this->belongsToMany(Offer::class, 'branch_offer' , 'branch_id');
    }


    public function favoredByClients()
    {
        return $this->belongsToMany(Client::class, 'favorite_branches', 'branch_id', 'client_id');
    }
    
}
