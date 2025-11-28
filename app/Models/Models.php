<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Models extends Model
{
     public $fillable = ["name", "body", "producer_id"];

    public function producer() {
        return $this->belongsTo("App\Models\Producer");
    }

}
