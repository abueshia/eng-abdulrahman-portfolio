<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgrammeItinerary extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function programme() {
        return $this->belongsTo(Programme::class, 'programme_id', 'id');
    }

    public function programmeItineraryItems() {
        return $this->hasMany(ProgrammeItineraryItem::class, 'programme_itinerary_id', 'id');
    }
}
