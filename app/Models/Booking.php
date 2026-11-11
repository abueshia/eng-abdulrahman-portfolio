<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function hotel() {
        return $this->belongsTo(Hotel::class, 'hotel_id', 'id');
    }

    public function room() {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function rates() {
        return $this->hasMany(Rate::class,'booking_id', 'id');
    }

    public function serial() :Attribute
    {
        return Attribute::get(function (){
            return Carbon::parse($this->created_at)->format('Ymd') . $this->id ;
        });
//        return Carbon::parse($this->created_at)->format('Ymd');
    }

}
