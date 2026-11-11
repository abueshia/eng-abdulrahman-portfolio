<?php

namespace App\Models;

use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
// use Spatie\Translatable\HasTranslations;

class Complaint extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HandleUploadFile;

    protected $table = 'complaint'; 

    protected $fillable = ['name', 'email' , 'phone' , 'message' ];

    protected $guarded = ['id'];

    // public $translatable = ['title', 'description', 'meta_title', 'meta_description', 'meta_tags', 'alt_text'];

    public function scopeOrdered($q)
    {
        return $q->orderBy('id', 'asc');
    }
}





