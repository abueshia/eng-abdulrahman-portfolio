<?php

namespace App\Models;

use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Product extends Model implements HasMedia
{

    use HasFactory, InteractsWithMedia, HandleUploadFile , HasTranslations;

    // use InteractsWithMedia;

    protected $table = 'products';
    
    protected $fillable = ['name' , 'description', 'productcategory_id' , 'is_favorite'];


    public function getImageUrl()
    {
        return $this->getFirstMediaUrl('default');
    }

    protected $guarded = ['id'];

    public $translatable = ['name' , 'description'];

    public function scopeOrdered($q)
    {
        return $q->orderBy('id', 'asc');
    }

    // العلاقة مع العروض (many-to-many)
    public function offers()
    {
        return $this->belongsToMany(Offer::class, 'offer_product');
    }


    public function coupons()
    {
        return $this->hasMany(Coupon::class, 'product_id');
    }

    // العلاقة مع فئة المنتج (Belongs To)
    public function productCategory()
    {
        return $this->belongsTo(Productcategory::class, 'productcategory_id');
    }

    public function favoredByClients()
    {
        return $this->belongsToMany(Client::class, 'favorite_products', 'product_id', 'client_id');
    }

    //  بداية
    public function voucherspages()
    {
        return $this->hasMany(Voucherspage::class);
    }

}
