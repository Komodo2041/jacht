<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Types extends Model
{
    public  $fillable = ["name", "feature", "number_of_people", "routes", "organization_costs", "requirements", "body"]; 
}
