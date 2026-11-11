<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgrammeRate extends Model
{
    use HasFactory;

    protected $fillable = [
        'rate',
        'comment',
        'status',
        'programme_booking_id',
        'programme_id'
    ];

    public function programme() {
        return $this->belongsTo(Programme::class, 'programme_id', 'id');
    }
    public function booking() {
        return $this->belongsTo(ProgrammeBooking::class, 'programme_booking_id', 'id');
    }
}
