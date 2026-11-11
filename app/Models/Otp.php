<?php

namespace App\Models;

use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Otp extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HandleUploadFile;

    protected $table = 'otp';
 
    protected $fillable = ['phone' , 'code' , 'is_active'] ;

    protected $guarded = ['id'];

    public function scopeOrdered($q)
    {
        return $q->orderBy('id', 'asc');
    }

}
