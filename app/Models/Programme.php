<?php

namespace App\Models;

use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Programme extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia, HandleUploadFile;

    public static $status = [
        1 => 'Active',
        0 => 'In Active',
    ];

    public function getCompleteAddress()
    {
        return $this->location_name . ', ' .
            $this->region->name . ', ' .
            $this->city->name . ', ' .
            $this->country->name;
    }
    public function getAvgRateAttribute($avg) {
        if ($avg > 0) {
            return round($avg);
        } else {
            return 0;
        }
    }

    public function scopeActive($q)
    {
        return $q->where('status', 1);
    }
    public function scopeFeatured($q) {
        return $q->where('is_featured', 1);
    }
    public $translatable = ['name', 'location_name', 'description'];

    protected $fillable = [
        'name',
        'country_id',
        'city_id',
        'region_id',
        'location_name',
        'rate',
        'star',
        'duration',
        'tour_type_id',
        'group_size',
        'description',
        'map',
        'longitude',
        'latitude',
        'check_in',
        'check_out',
        'status',
        'email',
        'phone',
        'is_featured',


        'price',
        'discount_type',
        'discount',
        'valid_from',
        'valid_to',

        
        'facebook',
        'instagram',
        'twitter',
        'gmail',
        'meta_title',
    ];

    public function getMainImage() {
        return $this->getFirstMediaUrl('programmes');
    }

    public function rates() {
        return $this->hasMany(ProgrammeRate::class,'programme_id', 'id');
    }
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id', 'id');
    }

    public function tourType()
    {
        return $this->belongsTo(TourType::class, 'tour_type_id', 'id');
    }

    public function programmeImages()
    {
        return $this->hasMany(ProgrammeImage::class, 'programme_id', 'id');
    }

    public function programmeIncludes()
    {
        return $this->hasMany(ProgrammeInclude::class, 'programme_id', 'id');
    }

    public function programmeItinerary()
    {
        return $this->hasMany(ProgrammeItinerary::class, 'programme_id', 'id');
    }

    public function programmeItineraryItems() {
    return $this->hasManyThrough(ProgrammeItineraryItem::class, ProgrammeItinerary::class, 'programme_id', 'programme_itinerary_id');
}

    public function getProgrammeStatus()
    {
        foreach (self::$status as $key => $val) {
            if ($key == $this->attributes['status']) {
                return $val;
            }
        }
    }


}
