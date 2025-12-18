<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Crew extends Model
{
    public $fillable = [
       "firstname",
       "lastname",
       "email",
       "passport_number",
       "notes",
       "country_id",
       "job_id",
       "status",
    ]; 

    public function country() {
        $this->belongsTo("App\Models\Nationality", "country_id");
    }

    public function job() {
        $this->belongsTo("App\Models\Job", "job_id");
    }

}
        
          
            
             
        
 