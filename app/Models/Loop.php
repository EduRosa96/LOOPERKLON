<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Tag;
use App\Models\LoopTag;
use Illuminate\Database\Eloquent\Model;


class Loop extends Model
{
    protected $table = 'loops';
    protected $fillable = [
        'title',
        'description',
        'filename',
        'bpm',
        'key_signature'
    ];
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
