<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgrammeBooking extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function programme() {
        return $this->belongsTo(Programme::class, 'programme_id', 'id');
    }

    // public function user() {
    //     return $this->belongsTo(User::class, 'user_id', 'id');
    // }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function rates() {
        return $this->hasMany(ProgrammeRate::class,'programme_booking_id', 'id');
    }
    public function serial() :Attribute
    {
        return Attribute::get(function (){
            return Carbon::parse($this->created_at)->format('Ymd') . $this->id ;
        });
    }
}
