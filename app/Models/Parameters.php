<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parameters extends Model
{
    public $fillable = ["name", "unit"];
    public $table = "parametrs";
}
