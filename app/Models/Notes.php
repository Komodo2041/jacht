<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    public $table = "producer_notes";
    public $fillable = ["body", "producer_id"];
 
    public function producer() {
        return $this->belongsTo("App\Models\Producer");
    }    

}
