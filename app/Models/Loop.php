<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Loop extends Model
{
    use HasFactory;

    protected $table = 'loops';

    protected $fillable = [
        'title',
        'description',
        'bpm',
        'key_signature',
        'filename',
        'user_id',
    ];

    /**
     * Relación: un loop pertenece a un usuario
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación: un loop puede tener muchas etiquetas (tags)
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
