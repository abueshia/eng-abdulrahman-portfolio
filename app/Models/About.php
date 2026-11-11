<?php

namespace App\Models;

use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class About extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HandleUploadFile, HasTranslations;

     protected $table = 'abouts';

    protected $fillable = ['title','description' , 'description_story' , 'description_see_us' , 'description_our_mission' , 'description_about_the_plan'];

    protected $guarded = ['id'];

    public $translatable = ['title', 'description', 'description_story', 'description_see_us', 'description_our_mission', 'description_about_the_plan'];

    public function scopeOrdered($q)
    {
        return $q->orderBy('id', 'asc');
    }
}
