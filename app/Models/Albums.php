<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Albums extends Model
{

   public $fillable = [
      'name',
      'body',
      'albumable_id',
      'albumable_type'  
    ];

   public function albumable()
    {
        return $this->morphTo();
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
