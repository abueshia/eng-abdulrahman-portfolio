<?php

namespace App\Models;

use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class City extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HandleUploadFile, HasTranslations;

    protected $fillable = ['name', 'country_id', 'parent_id', 'lft', 'rgt', 'depth' , 'meta_title'];

    public $translatable = ['name' , 'meta_title'];

    // public $table = 'cities_airs';

    protected $guarded = ['id'];

    public function country() {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function programmes()
    {
        return $this->hasMany(Programme::class, 'city_id', 'id');
    }


    public function clients()
    {
        return $this->hasMany(Client::class, 'city_id', 'id');
    }


    public function branche()
    {
        return $this->hasMany(Branche::class, 'city_id', 'id');
    }
    

    public function scopeOrdered($q)
    {
        return $q->orderBy('lft', 'asc');
    }
}
