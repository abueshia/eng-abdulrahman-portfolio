<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityAir extends Model
{
    use HasFactory;

    protected $table = 'cities_airs';

    public function airMasters() {
        return $this->hasMany(AirMaster::class, 'city_id', 'id');
    }
}
