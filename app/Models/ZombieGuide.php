<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ZombieGuide extends Model
{
    protected $fillable = [
        'game',
        'map_slug',
        'title',
        'description',
        'content',
        'image',
        'is_published',
        'views',
        'user_id'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'views' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
