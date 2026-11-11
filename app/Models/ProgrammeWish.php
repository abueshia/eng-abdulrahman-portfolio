<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgrammeWish extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'programme_id'];


    public function programme()
    {
        return $this->belongsTo(Programme::class, 'programme_id', 'id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public static function wishCount()
    {
        if (auth()->check())
            return ProgrammeWish::where('user_id', auth()->user()->id)->count();
        return 0;
    }
}
