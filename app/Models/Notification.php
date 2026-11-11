<?php

namespace App\Models;

use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Notification extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HandleUploadFile;

    protected $table = 'notifications'; 

    protected $fillable = ['name','message' , 'user_id', 'payload' ];

    protected $guarded = ['id'];

    // public $translatable = ['title', 'description', 'meta_title', 'meta_description', 'meta_tags', 'alt_text'];

    public function scopeOrdered($q)
    {
        return $q->orderBy('id', 'asc');
    }


    public function client()
    {
        return $this->belongsTo(Client::class, 'user_id', 'id');
    }
}
