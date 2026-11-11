<?php

namespace App\Models;

use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Privacypolicy extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HandleUploadFile , HasTranslations;

    protected $table = 'privacy_policy';
    
    protected $fillable = ['description'];

    protected $guarded = ['id'];

    public $translatable = ['description'];

    public function scopeOrdered($q)
    {
        return $q->orderBy('id', 'asc');
    }
}
