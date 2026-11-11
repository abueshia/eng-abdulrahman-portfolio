<?php

namespace App\Models;

use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Testimonial extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HandleUploadFile , HasTranslations;


    protected $fillable = ['name', 'name_job' , 'description' , 'meta_title', 'rating'];

    protected $guarded = ['id'];

    public $translatable = ['name', 'name_job', 'description' , 'meta_title'];


    public function scopeOrdered($q)
    {
        return $q->orderBy('id', 'asc');
    }
    
    }
