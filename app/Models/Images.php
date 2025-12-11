<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Storage;

class Images extends Model
{
     public $fillable = [
        "album_id",
        "title",
        "description",
        "filename",
        "path",
        "mime_type",
    ];

    public function getUrlAttribute()
    {
        return Storage::disk('public')->url($this->path);
    }    
}
