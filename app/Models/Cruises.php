<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cruises extends Model
{
    public $table = "cruises";
    public $fillable = ["yacht_id", "date_from", "date_to", "port_start_id", "port_end_id", "name", "body", "status" ];

    public function crew() {
        return $this->belongsTo("App\Models\Crew", "crew_id");
    }

    public function portstart() {
        return $this->belongsTo("App\Models\Ports", "port_start_id");
    }

    public function portend() {
        return $this->belongsTo("App\Models\Ports", "port_end_id");
    }   
    
    public function yacht() {
        return $this->belongsTo("App\Models\Yachts", "yacht_id");
    }  

    public function albums()
    {
        return $this->morphMany(Albums::class, 'albumable');
    }    

    public function documents()
    {
        return $this->morphMany(Documents::class, 'documentable');
    }    

    public function clients() {
        return $this->belongsToMany(Clients::class, ClientCourses::class, "course_id",  "client_id")->withPivot('payment');  
    }
    
}
