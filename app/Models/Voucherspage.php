<?php

namespace App\Models;

use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
// use Spatie\Translatable\HasTranslations;
// use Spatie\Translatable\HasTranslations;

class  Voucherspage extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HandleUploadFile;

    protected $table = 'voucherspage'; 

    protected $fillable = ['client_id', 'offer_id' , 'product_id' , 'coupon_id', 'points' , 'status'];

    protected $guarded = ['id'];

    // public $translatable = ['client_id', 'offer_id', 'product_id'];

    public function scopeOrdered($q)
    {
        return $q->orderBy('id', 'asc');
    }

    // بداية
    // العلاقة مع جدول clients
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // العلاقة مع جدول offers
    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    // العلاقة مع جدول products
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // العلاقة مع جدول coupons
    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

}






