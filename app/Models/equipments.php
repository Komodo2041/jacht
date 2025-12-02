<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipments extends Model
{

    public $fillable = ['name', 'body', 'category_id'];
    public $table = "equipment";

    public function category() {
        return $this->belongsTo("App\Models\Equipment_category", "category_id" );
    }
}
