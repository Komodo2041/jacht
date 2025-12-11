<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
     public $fillable = [
        "album_id",
        "title",
        "description",
        "filename",
        "path",
        "mimr_type",
    ];
}
