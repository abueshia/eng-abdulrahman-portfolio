<?php

namespace App\Models;

use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Offer extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HandleUploadFile , HasTranslations;

    protected $table = 'offers'; 
    
    protected $fillable = ['name', 'description' , 'point' , 'discount' , 'branches' , 'products' , 'discount_number'];

    protected $guarded = ['id'];

    public $translatable = ['name', 'description'];

    public function scopeOrdered($q)
    {
         return $q->orderBy('id', 'asc');
    }

    // العلاقة مع المنتجات (many-to-many)
    public function products()
    {
        return $this->belongsToMany(Product::class, 'offer_product');
    }

    // العلاقة مع الفروع (many-to-many)
    public function branches()
    {
        return $this->belongsToMany(Branche::class, 'branch_offer', 'offer_id', 'branch_id');
    }


    
    public function favoredByClients()
    {
        return $this->belongsToMany(Client::class, 'favoriteoffers', 'offer_id', 'client_id');
    }
    

    // بداية 
    public function voucherspages()
    {
        return $this->hasMany(Voucherspage::class);
    }

    // تحديد العلاقة مع موديل Vouchercodeoffer
    // public function voucherCodeOffers()
    // {
    //     return $this->hasMany(Vouchercodeoffer::class, 'offer_id', 'id');
    // }
 
    public function voucherCodeOffers()
    {
        return $this->belongsToMany(Offer::class, 'voucher_code_offer','offer_id', 'client_id');
    }

    // جديد 
    public function voucherCodeOffersNow()
    {
        return $this->hasMany(Vouchercodeoffer::class, 'offer_id');
    }
}
