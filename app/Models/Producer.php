<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producer extends Model
{
    public $table = "Producer";
    public $fillable = ["name", "volume"];

    public function models() {
        return $this->hasMany("App\Models\Models");
    }

    public function notes() {
        return $this->hasMany("App\Models\Notes");
    }
}
