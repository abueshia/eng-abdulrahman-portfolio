<?php

namespace App\Models;

use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
class Categorycolid extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HandleUploadFile , HasTranslations ;

    protected $table = 'category_colid';

    protected $fillable = ['name' , 'category_id'];


  public $translatable = ['name'];    
  
  
    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    protected $guarded = ['id'];

    // public function scopeOrdered($q)
    // {
    //     return $q->orderBy('lft', 'asc');
    // }

    public function card()
    {
        return $this->hasMany(Card::class);
    }

    
}
