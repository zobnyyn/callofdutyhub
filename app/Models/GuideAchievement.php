<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GuideAchievement extends Model
{
    protected $fillable = [
        'user_id',
        'zombie_guide_id',
        'completed_at',
        'display_order',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
        'display_order' => 'integer',
    ];

    /**
     * Получить пользователя, которому принадлежит достижение
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Получить гайд, за который получено достижение
     */
    public function guide(): BelongsTo
    {
        return $this->belongsTo(ZombieGuide::class, 'zombie_guide_id');
    }
}
