<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ports extends Model
{
 
    public $fillable = ["name", "geolocation", "country_id"];

    public function country() {
        return $this->belongsTo("App\Models\Nationality", "country_id" );
    }

}
