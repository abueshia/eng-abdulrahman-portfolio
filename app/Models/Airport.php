<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Airport extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['air_id', 'air_code', 'name', 'city_code', 'country_name', 'city_name'];

    public $translatable = [
        'name',
        'country_name',
        'city_name',
    ];


}
