<?php

namespace App\Models;

use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Gallery extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HandleUploadFile , HasTranslations;

    protected $fillable = ['name' , 'categorygallery_id' ,'meta_title'];

    public function Categorygallery()
    {
        return $this->belongsTo(Categorygallery::class, 'categorygallery_id');
    }

    public $translatable = ['meta_title'];

    protected $guarded = ['id'];

    public function scopeOrdered($q)
    {
        return $q->orderBy('id', 'asc');
    }
}




