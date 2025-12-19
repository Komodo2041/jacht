<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrewPort extends Model
{
    public $fillable = ["port_id", "crew_id"];

    public function crew() {
        return $this->belongsTo("App\Models\Crew", "crew_id");
    }

    public function port() {
        return $this->belongsTo("App\Models\Ports", "crew_id");
    }    

}
