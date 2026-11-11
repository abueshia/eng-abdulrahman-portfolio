<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ProgrammeItineraryItem extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['details'];

    protected $fillable = ['details', 'programme_itinerary_id'];

    public function programmeItinerary() {
        return $this->belongsTo(ProgrammeItinerary::class, 'programme_itinerary_id', 'id');
    }
}
