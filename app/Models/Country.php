<?php

namespace App\Models;

use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Country extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HandleUploadFile, HasTranslations;

    protected $fillable = ['name', 'parent_id', 'lft', 'rgt', 'depth' , 'meta_title'];

    public $translatable = ['name' , 'meta_title'];

    protected $guarded = ['id'];

    public function scopeOrdered($q)
    {
        return $q->orderBy('lft', 'asc');
    }

    public function programmes()
    {
        return $this->hasMany(Programme::class, 'country_id', 'id');
    }


    public function clients()
    {
        return $this->hasMany(Client::class, 'country_id');
    }


}
