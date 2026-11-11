<?php

namespace App\Models;

use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
// use Spatie\Translatable\HasTranslations;

class Paymentpicture extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HandleUploadFile ;


    protected $table = 'payment_pictures';
    // protected $fillable = ['name', 'name_job' , 'description'];

    protected $guarded = ['id'];

    // public $translatable = ['name', 'name_job', 'description'];

    public function scopeOrdered($q)
    {
        return $q->orderBy('id', 'asc');
    }
}
