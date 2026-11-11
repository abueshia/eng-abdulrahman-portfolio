<?php

namespace App\Models;

use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class ProgrammeInclude extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['details', 'programme_id'];

    public $translatable = ['details'];

    public function programme() {
        return $this->belongsTo(Programme::class, 'programme_id', 'id');
    }
}
