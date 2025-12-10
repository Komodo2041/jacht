<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YachtEq extends Model
{
    public $table = "yacht_equipments";
    public $fillable = ["yacht_id", "eq_id", "value"];
}
