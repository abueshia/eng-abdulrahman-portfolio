<?php

namespace App\Models;

use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Termsandcondition extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HandleUploadFile , HasTranslations;


    protected $table = 'terms_and_condition';

    protected $fillable = ['description'];

    protected $guarded = ['id'];

    public $translatable = ['description'];

    public function scopeOrdered($q)
    {
        return $q->orderBy('id', 'asc');
    }
}
