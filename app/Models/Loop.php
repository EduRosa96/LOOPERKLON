<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Tag;
use App\Models\LoopTag;


class Loop extends Model
{
    protected $fillable = [
        'title', 'description', 'filename', 'bpm', 'key_signature',
    ];
    public function tags()
{
    return $this->belongsToMany(Tag::class);
}

}

