<?php

namespace App\Models;

use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Hotel extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia, HandleUploadFile;
    protected $guarded = [];

    public static $status = [
        1 => 'Active',
        0 => 'In Active',
    ];

    public $translatable = ['address','hotel_description','description_condition','description_policy','description_children_age', 'name'];


    public function getHotelStatus(){
        foreach(self::$status as $key => $val){
            if($key == $this->attributes['status']){
              return $val;
            }
        }
    }

    public function rates() {
        return $this->hasMany(Rate::class,'hotel_id', 'id');
    }

    public function scopeFeatured($q) {
        return $q->where('is_featured', 1);
    }
    public function scopeLatestHotels($q) {
        return $q->orderBy('id', 'desc')->limit(10);
    }
    public function scopeActive($q) {
        return $q->where('status', 1);
    }
    public function getCompleteAddress(){
        return $this->address . ', ' .
            $this->region->name . ', ' .
            $this->city->name . ', ' .
            $this->country->name;
    }

    public function getHotelMainImage()
    {
        if (array_key_exists('main_image', $this->attributes)) {


            if ($this->attributes['main_image']) {
              return url('/').'/assets/Hotel/Images/'.$this->attributes['main_image'] ?? '';
            }

            return null;
        }
    }
    public function getAvgRateAttribute($avg) {
        if ($avg > 0) {
            return round($avg);
        } else {
            return 0;
        }
    }

    public function getImagePath()
    {
        if (array_key_exists('main_image', $this->attributes)) {

            if ($this->attributes['main_image']) {
              return '/assets/Hotel/Images/'.$this->attributes['main_image'] ?? '';
            }else{
                return '/assets/Hotel/Images';
            }
        }
    }
    public function getMainImageAttribute($val) {
        if ($val != null) {
            return 'assets/Hotel/Images/' . $val;
        } else {
            return null;
        }
    }

    public function country(){
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function city(){
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
    public function region(){
        return $this->belongsTo(Region::class, 'region_id', 'id');
    }


    public function facilitates(){
        return $this->belongsToMany(Facilitate::class,'hotel_facilitates','hotel_id','facilitate_id');
    }


    public function accommodations(){
        return $this->belongsToMany(Accommodation::class,'hotel_accommodations','hotel_id','accommodation_id');
    }


    public function manager(){
       return $this->belongsTo(Manager::class,'manager_id');
    }

    public function hotelImages(){
        return $this->hasMany(HotelImage::class,'hotel_id');
     }

     public function rooms(){
        return $this->hasMany(Room::class,'hotel_id');
     }

     public function reviews() {
        return $this->hasMany(Review::class, 'hotel_id', 'id');
     }


}
