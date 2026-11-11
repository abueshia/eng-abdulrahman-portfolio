<?php

namespace App\Models;

use App\Traits\HandleUploadFile;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Client extends Authenticatable implements HasMedia 
{
    use HasFactory, InteractsWithMedia, HandleUploadFile, Notifiable, HasApiTokens ;

    protected $table = 'clients';
 
    protected $fillable = ['name', 'phone' , 'card' ,'username' , 'password' , 'is_banned' , 'category' , 'city_id' , 'region_id' , 'points' , 'is_active'  , 'paintscategory_id' , 'country_id' , 'fcm_token' , 'code_for_client' , 'code_add_invite_friend'] ;

    // public function categories()
    // {
    //     return $this->belongsTo(Category::class, 'category_id');
    // }

    // public function tags() {
    //     return $this->belongsToMany(Tag::class, 'tag_blogs');
    // }

    protected $guarded = ['id'];

    public function scopeOrdered($q)
    {
        return $q->orderBy('id', 'asc');
    }


    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id', 'id');
    }


    public function paintscategories(): BelongsToMany
    {
        return $this->belongsToMany(Paintscategory::class, 'paintscategory_client');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function favoriteBranches()
    {
        return $this->belongsToMany(Branche::class, 'favorite_branches', 'client_id', 'branch_id');
    }

    public function favoriteProducts()
    {
        return $this->belongsToMany(Product::class, 'favorite_products', 'client_id', 'product_id');
    }

    public function favoriteOffer()
    {
        return $this->belongsToMany(Offer::class, 'favoriteoffers', 'client_id', 'offer_id');
    }

    // بداية 
    public function voucherspages()
    {
        return $this->hasMany(Voucherspage::class);
    }


    // تحديد العلاقة مع موديل Vouchercodeoffer
    public function voucherCodeOffers()
    {
        return $this->belongsToMany(Offer::class, 'voucher_code_offer', 'client_id' , 'offer_id');
    }

    // جديد
    public function voucherCodeOffersStar()
    {
        return $this->hasMany(Vouchercodeoffer::class, 'client_id');
    }

    
}
