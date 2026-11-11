<?php

namespace App\Models;

use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Categorygallery extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HandleUploadFile , HasTranslations;

    protected $table = 'categorygalleries';

   

    protected $fillable = ['name', 'parent_id', 'lft', 'rgt', 'depth' , 'meta_title'];

    public $translatable = ['name', 'meta_title'];
   
    public function gallerys()
    {
        return $this->hasMany(Gallery::class);
    }

    protected $guarded = ['id'];

    public function scopeOrdered($q)
    {
        return $q->orderBy('lft', 'asc');
    }
}






