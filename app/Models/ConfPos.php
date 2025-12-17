<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfPos extends Model
{
   public $table = "confpos";
 
   public $fillable = [
      'yacht_id',
      'job_id',
      'value' 
    ];    

   public function yacht() {
       return $this->belongsTo("App\Models\Yachts", 'dept_id');
   }

   public function job() {
       return $this->belongsTo("App\Models\Job", 'dept_id');
   }

}
