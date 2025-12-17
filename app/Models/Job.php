<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    public $table = "jobs_positions";
    public $fillable = ["name", "dept_id"];

    public function department() {
        return $this->belongsTo("App\Models\Departments", 'dept_id');
    }

    public function options() {
        return $this->hasMany("App\Models\ConfPos", "job_id");
    }
    
}
