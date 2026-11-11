<?php

namespace App\Models;

use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Place extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HandleUploadFile, HasTranslations;

    protected $fillable = ['title','image', 'placecat_id'];
    // 'meta_image' 'slug',  ,
    protected $guarded = ['id'];

    public $translatable = ['title','image' , 'placecat_id'];


    public function placecat()
    {
        return $this->belongsTo(Placecat::class, 'placecat_id');
    }

    public function scopeOrdered($q)
    {
        return $q->orderBy('id', 'asc');
    }
}
