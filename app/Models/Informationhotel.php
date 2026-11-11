<?php

namespace App\Models;

use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Informationhotel extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HandleUploadFile , HasTranslations;

    protected $table = 'information_hotels';

    protected $fillable = ['name', 'linke' , 'meta_title'];

    protected $guarded = ['id'];

    public $translatable = ['name', 'meta_title'];

    public function scopeOrdered($q)
    {
        return $q->orderBy('id', 'asc');
    }
}
