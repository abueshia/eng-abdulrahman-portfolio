<?php

namespace App\Models;

use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;


class Group extends Model implements HasMedia

{
    use HasFactory, InteractsWithMedia, HandleUploadFile;

    protected $table = 'groups'; 

    protected $fillable = ['name' , 'is_valid' , 'is_banned' , 'points' , 'validate_to'];
    
    protected $guarded = ['id'];


    public function scopeOrdered($q)
    {
        return $q->orderBy('id', 'asc');
        
    }

    
    public function coupons()
    {
        return $this->hasMany(Coupon::class, 'group_id', 'id');
    }

}
