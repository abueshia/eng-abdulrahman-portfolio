<?php

namespace App\Models;

use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
class Category extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HandleUploadFile , HasTranslations ;

    protected $fillable = ['name', 'parent_id', 'lft', 'rgt', 'depth', 'meta_title', 'meta_description', 'meta_tags', 'alt_text','slug' ];


  public $translatable = ['name'];    
    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function card()
    {
        return $this->hasMany(Card::class);
    }


    public function categorycolid()
    {
        return $this->hasMany(Categorycolid::class);
    }

    protected $guarded = ['id'];

    public function scopeOrdered($q)
    {
        return $q->orderBy('lft', 'asc');
    }
    
}
