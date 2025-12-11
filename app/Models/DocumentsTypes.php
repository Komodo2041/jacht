<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentsTypes extends Model
{
    public $fillable = ["name"];
    public $table = "documents_types";
}
