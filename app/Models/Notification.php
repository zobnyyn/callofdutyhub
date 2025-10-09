<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'from_user_id',
        'type',
        'message',
        'data',
        'read',
    ];

    protected $casts = [
        'data' => 'array',
        'read' => 'boolean',
    ];

    /**
     * Пользователь, которому предназначено уведомление
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Пользователь, от которого уведомление
     */
    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    /**
     * Scope для непрочитанных уведомлений
     */
    public function scopeUnread($query)
    {
        return $query->where('read', false);
    }

    /**
     * Отметить как прочитанное
     */
    public function markAsRead()
    {
        $this->update(['read' => true]);
    }
}

