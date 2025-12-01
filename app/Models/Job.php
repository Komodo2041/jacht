<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    public $table = "jobs_positions";
    public $fillable = ["name", "dept_id"];
}
