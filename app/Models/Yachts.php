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
        "build_year",
        "model_id",
        "type_id"
    ]; 

    public function models() {
        return $this->belongsTo(Models::class, "model_id");
    }

     public function producers() {
        return $this->belongsTo("App\Models\Producer", "producer_id");
    }  
    
     public function type() {
        return $this->belongsTo("App\Models\Types", "type_id");
    }   
 
    public function port() {
        return $this->belongsToMany(Ports::class, ActualPort::class, "yachts_id", "port_id");                
    }

    public function parametrs() {
        return $this->belongsToMany(Parameters::class, YachtsParametrs::class, "yacht_id", "parametr_id")->withPivot('value');  
    }
}

 