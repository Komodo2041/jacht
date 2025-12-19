<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YachtCrew extends Model
{
    public $table = "crewport";
    public $fillable = ["crew_id", "yacht_id"];
    
}
