<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    public $fillable = ['documentable_id', 'documentable_type',
        'title', 'type_id', 'filename', 'path',
        'issued_at', 'expires_at', 'notes',
        'file_size', 'mime_type'];

    public function documentable()
    {
        return $this->morphTo();
    }

    public function getUrlAttribute()
    {
        return asset('storage/' . $this->path);
    }

    public function type() {
        return $this->belongsTo("App\Models\DocumentsTypes", 'type_id');
    }

}
