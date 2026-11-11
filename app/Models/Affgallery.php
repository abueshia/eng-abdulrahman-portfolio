<?php

namespace App\Models;

use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Affgallery extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HandleUploadFile;

    protected $table = "aff_galleries";

    protected $fillable = [
    'gallery_id',
    ];

    protected $guarded = ['id'];


    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }


    public function scopeOrdered($q)
    {
        return $q->orderBy('id', 'asc');
    }
}





