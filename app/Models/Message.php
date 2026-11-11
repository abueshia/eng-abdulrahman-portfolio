<?php

namespace App\Models;

use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
// use Spatie\Translatable\HasTranslations;

class Message extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HandleUploadFile ;
    // HasTranslations
    protected $table = 'messages';
    
    protected $fillable = ['name', 'message' , 'email' , 'phone' , 'city', 'type', 'service'];

    // public $translatable = ['name', 'message', 'email', 'phone' , 'city'];

    protected $guarded = ['id'];

    public function scopeOrdered($q)
    {
        return $q->orderBy('lft', 'asc');
    }
}
