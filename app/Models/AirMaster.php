<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirMaster extends Model
{
    use HasFactory;

    protected $table = "air_masters";

    public function city() {
        return $this->belongsTo(CityAir::class, 'city_id', 'id');
    }

}
