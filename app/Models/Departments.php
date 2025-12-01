<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    //
    public $fillable = ["name"];
    public $table = "departments";

    public function jobs() {
        return $this->hasMany("App\Models\Job");
    } 
}


