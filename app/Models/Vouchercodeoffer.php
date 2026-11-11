<?php

namespace App\Models;

use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
// use Spatie\Translatable\HasTranslations;
// use Spatie\Translatable\HasTranslations;

class  Vouchercodeoffer extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HandleUploadFile;

    protected $table = 'voucher_code_offer'; 

    protected $fillable = ['client_id', 'offer_id' , 'discount_number', 'points' ];

    protected $guarded = ['id'];

    // public $translatable = ['client_id', 'offer_id', 'product_id'];

    public function scopeOrdered($q)
    {
        return $q->orderBy('id', 'asc');
    }

// جديد
    public function offer()
    {
        return $this->belongsTo(Offer::class, 'offer_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

}






