<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class TourType extends Model
{
    use HasFactory, HasTranslations;
    protected $guarded = [];
    public $translatable = ['name' , 'meta_title'];

    public function scopeSearch($q){

        $q->when(request('search') != null ,function($q){
            return $q->where('name->ar','like','%'.request('search').'%')
                ->orWhere('name->en','like','%'.request('search').'%');
        });
    }

    public function programmes() {
        return $this->hasMany(Programme::class, 'tour_type_id', 'id');
    }
}
