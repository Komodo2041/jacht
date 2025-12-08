<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Yachts extends Model
{
    public  $fillable = [
        "name",
        "producer_id",
        "model",
        "engine_brand",
        "engine_model",
        "engine_count",
        "propeller_type",
        "fuel_tank_liters",
        "water_tank_liters",
        "length_meters",
        "cabins",
        "berths",
        "build_year"
    ]; 
}

 