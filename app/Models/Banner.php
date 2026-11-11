<?php

namespace App\Models;

use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
// use Spatie\Translatable\HasTranslations;

class Banner extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HandleUploadFile ;


    protected $table = 'banners';
    protected $fillable = ['title', 'description'];

    // protected $guarded = ['id'];

    // public $translatable = ['name', 'name_job', 'description'];

    public function scopeOrdered($q)
    {
        return $q->orderBy('id', 'asc');
    }
}
