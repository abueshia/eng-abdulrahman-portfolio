<?php

namespace App\Models;

use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Placecat extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HandleUploadFile, HasTranslations;

    protected $fillable = ['title'];

// ,  'meta_title', 'meta_description', 'meta_tags', 'alt_text', 'description'
    protected $guarded = ['id'];

    public $translatable = ['title'];

    public function place()
    {
        return $this->hasMany(Place::class);
    }

    public function scopeOrdered($q)
    {
        return $q->orderBy('id', 'asc');
    }
}
