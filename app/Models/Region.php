<?php

namespace App\Models;

use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Region extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HandleUploadFile, HasTranslations;

    protected $fillable = ['name', 'city_id', 'parent_id', 'lft', 'rgt', 'depth' , 'meta_title'];

    public $translatable = ['name' , 'meta_title'];

    protected $guarded = ['id'];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function programmes()
    {
        return $this->hasMany(Programme::class, 'region_id', 'id');
    }

    public function clients()
    {
        return $this->hasMany(Client::class, 'region_id', 'id');
    }

    public function scopeOrdered($q)
    {
        return $q->orderBy('lft', 'asc');
    }
}
