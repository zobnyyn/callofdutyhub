<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GroupMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_group_id',
        'user_id',
        'message',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Группа, к которой относится сообщение
     */
    public function gameGroup(): BelongsTo
    {
        return $this->belongsTo(GameGroup::class, 'game_group_id');
    }

    /**
     * Автор сообщения
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

