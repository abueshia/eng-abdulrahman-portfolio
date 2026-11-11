<?php

namespace App\Models;

use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Paintscategory extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HandleUploadFile, HasTranslations;

    protected $table = 'paints_category'; 

    protected $fillable = ['name'];

    protected $guarded = ['id'];

    public $translatable = ['name'];

    public function scopeOrdered($q)
    {
        return $q->orderBy('id', 'asc');
    }


    public function clients()
    {
        return $this->belongsToMany(Client::class, 'paintscategory_client');
    }

}
