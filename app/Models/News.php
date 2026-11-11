<?php

namespace App\Models;

use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class News extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HandleUploadFile , HasTranslations;


    protected $table = 'news';
    
    protected $fillable = ['title', 'des'];

    protected $guarded = ['id'];

    public $translatable = ['title', 'des'];

    public function scopeOrdered($q)
    {
        return $q->orderBy('id', 'asc');
    }
}
