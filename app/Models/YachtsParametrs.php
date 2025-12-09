<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YachtsParametrs extends Model
{
    public $table = "yachts_parameters";
    public $fillable = ["yacht_id", "parametr_id", "value"];

}
