<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TagsNotes extends Model
{
    public $table = "tags_notes";
    public $fillable = ["tag_id", "note_id"];
    public $timestamps = false;
}
