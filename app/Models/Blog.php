<?php

namespace App\Models;

use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Blog extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HandleUploadFile  , HasTranslations ;


    protected $fillable = ['name', 'meta_title', 'meta_description', 'meta_tags', 'alt_text', 'description', 'slug', 'category_id'];

    public $translatable = ['name', 'description'];

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    
    public function tags() {
        return $this->belongsToMany(Tag::class, 'tag_blogs');
    }

    protected $guarded = ['id'];

    public function scopeOrdered($q)
    {
        return $q->orderBy('id', 'asc');
    }
}
