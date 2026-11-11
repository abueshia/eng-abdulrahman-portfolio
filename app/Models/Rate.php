<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    protected $fillable = [
        'rate',
        'comment',
        'booking_id',
        'hotel_id',
        'status',
    ];

    public function hotel() {
        return $this->belongsTo(Hotel::class, 'hotel_id', 'id');
    }
    public function booking() {
        return $this->belongsTo(Booking::class, 'booking_id', 'id');
    }
}
