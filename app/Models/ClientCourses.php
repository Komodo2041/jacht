<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientCourses extends Model
{
    public $table = "clientcourses";
    public $fillable = ["client_id", "course_id", "payment"];


    public function client() {
        return $this->belongsTo("App\Models\Clients", 'client_id');
    }

    public function cuirse() {
        return $this->belongsTo("App\Models\Cruises", 'course_id');
    }
}
