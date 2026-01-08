<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    public $table = "clients";
    public $fillable = ["firstname", "lastname", "phone", "email"];

    public function documents()
    {
        return $this->morphMany(Documents::class, 'documentable');
    }    

}
