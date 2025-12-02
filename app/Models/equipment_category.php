<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment_category extends Model
{
    public $table = "categories";
    public $fillable = ["name", "body"];

    public function equipments() {
        return $this->hasmany("App\Models\Equipments", "category_id" );
    }



}
