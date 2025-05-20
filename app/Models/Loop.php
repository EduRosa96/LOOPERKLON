<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loop extends Model
{
    protected $fillable = [
        'title', 'description', 'filename', 'bpm', 'key_signature',
    ];
}

