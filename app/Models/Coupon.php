<?php

namespace App\Models;

use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Coupon extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HandleUploadFile , HasTranslations;

    protected $table = 'coupons'; 
    
    
    protected $fillable = ['group_id' , 'product_id' , 'code' , 'number' ,'name_group' , 'new_group_name' , 'is_valid' , 'points' , 'validate_to'];

    protected $guarded = ['id'];

    public $translatable = ['name'];

    public function scopeOrdered($q)
    {
        return $q->orderBy('id', 'asc');
    }

    // public function city()
    // {
    //     return $this->belongsTo(City::class, 'city_id', 'id');
    // }


    // public function users()
    // {
    //     return $this->hasMany(User::class, 'coupon_id', 'id');
    // }

    // // العلاقة مع العروض (many-to-many)
    // public function offers()
    // {
    //     return $this->belongsToMany(Offer::class, 'branch_offer' , 'branch_id');
    // }


    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }


    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // بداية
    public function voucherspages()
    {
        return $this->hasMany(Voucherspage::class);
    }

    
}
