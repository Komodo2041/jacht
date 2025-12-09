<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActualPort extends Model
{
       public  $fillable = [
        "yachts_id",
        "port_id"
       ];

       public $table = "actualport";
}
