<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Crew extends Model
{
    public $table = "crew";
    public $fillable = [
       "firstname",
       "lastname",
       "email",
       "passport_number",
       "notes",
       "country_id",
       "birthday",
       "job_id",
       "status",
       "port_id"
    ]; 

    public function country() {
        return $this->belongsTo("App\Models\Nationality", "country_id");
    }

    public function job() {
        return $this->belongsTo("App\Models\Job", "job_id");
    }

    public function documents()
    {
        return $this->morphMany(Documents::class, 'documentable');
    } 

    public function port()
    {
        return $this->hasOneThrough(Ports::class, CrewPort::class, "crew_id", "id", "id", "port_id");  
    }

    public function yacht()
    { 
         return $this->hasOneThrough(Yachts::class, YachtCrew::class, "crew_id", "id", "id", "yacht_id");  
    }    

}
        
          
            
             
        
 