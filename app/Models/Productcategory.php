<?php

namespace App\Models;

use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Productcategory extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HandleUploadFile, HasTranslations;

    protected $table = 'product_category'; 

    protected $fillable = ['name'];

    protected $guarded = ['id'];

    public $translatable = ['name'];

    public function scopeOrdered($q)
    {
        return $q->orderBy('id', 'asc');
    }


    // public function clients()
    // {
    //     return $this->belongsToMany(Client::class, 'paintscategory_client');
    // }

    // العلاقة مع المنتجات (One to Many)
    public function products()
    {
        return $this->hasMany(Product::class, 'productcategory_id');
    }


}
