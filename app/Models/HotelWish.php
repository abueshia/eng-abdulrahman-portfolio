<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelWish extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'hotel_id'];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public static function wishCount()
    {
        if (auth()->check())
            return HotelWish::where('user_id', auth()->user()->id)->count();
        return 0;
    }
}
