<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GameGroup extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'creator_id',
        'name',
        'description',
        'contact_link',
        'game',
        'game_mode',
        'platform',
        'max_members',
        'skill_level',
        'language',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'max_members' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Создатель группы
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    /**
     * Все участники группы (связь many-to-many)
     */
    public function members()
    {
        return $this->belongsToMany(User::class, 'game_group_members', 'game_group_id', 'user_id')
            ->withPivot('status', 'joined_at')
            ->withTimestamps();
    }

    /**
     * Только принятые участники
     */
    public function acceptedMembers()
    {
        return $this->members()->wherePivot('status', 'accepted');
    }

    /**
     * Проверка, является ли пользователь создателем группы
     */
    public function isCreator($userId)
    {
        return $this->creator_id == $userId;
    }

    /**
     * Проверка, является ли пользователь участником группы
     */
    public function isMember($userId)
    {
        // Создатель автоматически считается участником
        if ($this->isCreator($userId)) {
            return true;
        }

        return $this->members()
            ->where('user_id', $userId)
            ->wherePivot('status', 'accepted')
            ->exists();
    }

    /**
     * Получить текущее количество участников
     */
    public function getCurrentMembersCount()
    {
        // Создатель + принятые участники
        return 1 + $this->acceptedMembers()->count();
    }

    /**
     * Проверка наличия свободных мест
     */
    public function hasAvailableSlots()
    {
        return $this->getCurrentMembersCount() < $this->max_members;
    }

    /**
     * Сообщения группы
     */
    public function messages()
    {
        return $this->hasMany(GroupMessage::class, 'game_group_id');
    }
}
