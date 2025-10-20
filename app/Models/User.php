<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\ResetPasswordNotification;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'telegram',
        'discord',
        'xbox',
        'steam',
        'psn',
        'is_admin',
        'is_vip',
        'vip_expires_at',
        'donation_alerts_username',
        'admin_prefix',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
            'is_vip' => 'boolean',
            'vip_expires_at' => 'datetime',
        ];
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    /**
     * Проверить, является ли пользователь VIP
     */
    public function isVip(): bool
    {
        if (!$this->is_vip) {
            return false;
        }

        // Если VIP бессрочный (vip_expires_at = null)
        if ($this->vip_expires_at === null) {
            return true;
        }

        // Проверяем не истек ли VIP
        if ($this->vip_expires_at->isFuture()) {
            return true;
        }

        // VIP истек, убираем статус
        $this->update(['is_vip' => false, 'vip_expires_at' => null]);
        return false;
    }

    /**
     * Установить VIP статус пользователю
     */
    public function grantVip(int $days = null): void
    {
        $this->update([
            'is_vip' => true,
            'vip_expires_at' => $days ? now()->addDays($days) : null,
        ]);
    }

    /**
     * Продлить VIP статус
     */
    public function extendVip(int $days): void
    {
        $expiresAt = $this->vip_expires_at && $this->vip_expires_at->isFuture()
            ? $this->vip_expires_at->addDays($days)
            : now()->addDays($days);

        $this->update([
            'is_vip' => true,
            'vip_expires_at' => $expiresAt,
        ]);
    }

    /**
     * Получить достижения пользователя за просмотр гайдов
     */
    public function guideAchievements()
    {
        return $this->hasMany(GuideAchievement::class);
    }

    /**
     * Друзья пользователя (отправленные запросы)
     */
    public function friendsOfMine()
    {
        return $this->belongsToMany(User::class, 'friendships', 'user_id', 'friend_id')
            ->withPivot('status', 'created_at')
            ->wherePivot('status', 'accepted');
    }

    /**
     * Друзья пользователя (входящие запросы)
     */
    public function friendOf()
    {
        return $this->belongsToMany(User::class, 'friendships', 'friend_id', 'user_id')
            ->withPivot('status', 'created_at')
            ->wherePivot('status', 'accepted');
    }

    /**
     * Все друзья (объединение обоих направлений)
     */
    public function friends()
    {
        return $this->friendsOfMine->merge($this->friendOf);
    }

    /**
     * Входящие запросы в друзья
     */
    public function friendRequestsReceived()
    {
        return $this->belongsToMany(User::class, 'friendships', 'friend_id', 'user_id')
            ->withPivot('status', 'created_at')
            ->wherePivot('status', 'pending');
    }

    /**
     * Исходящие запросы в друзья
     */
    public function friendRequestsSent()
    {
        return $this->belongsToMany(User::class, 'friendships', 'user_id', 'friend_id')
            ->withPivot('status', 'created_at')
            ->wherePivot('status', 'pending');
    }

    /**
     * Проверить, являются ли пользователи друзьями
     */
    public function isFriendWith($userId)
    {
        return Friendship::where(function ($query) use ($userId) {
            $query->where('user_id', $this->id)
                ->where('friend_id', $userId);
        })->orWhere(function ($query) use ($userId) {
            $query->where('user_id', $userId)
                ->where('friend_id', $this->id);
        })->where('status', 'accepted')->exists();
    }

    /**
     * Проверить, есть ли ожидающий запрос в друзья
     */
    public function hasPendingFriendRequestWith($userId)
    {
        return Friendship::where(function ($query) use ($userId) {
            $query->where('user_id', $this->id)
                ->where('friend_id', $userId);
        })->orWhere(function ($query) use ($userId) {
            $query->where('user_id', $userId)
                ->where('friend_id', $this->id);
        })->where('status', 'pending')->exists();
    }

    /**
     * Получить статус дружбы с пользователем
     */
    public function getFriendshipStatusWith($userId)
    {
        $friendship = Friendship::where(function ($query) use ($userId) {
            $query->where('user_id', $this->id)
                ->where('friend_id', $userId);
        })->orWhere(function ($query) use ($userId) {
            $query->where('user_id', $userId)
                ->where('friend_id', $this->id);
        })->first();

        if (!$friendship) {
            return 'none';
        }

        if ($friendship->status === 'accepted') {
            return 'friends';
        }

        if ($friendship->status === 'pending') {
            if ($friendship->user_id === $this->id) {
                return 'request_sent';
            } else {
                return 'request_received';
            }
        }

        return $friendship->status;
    }

    /**
     * Получить отображаемое имя с префиксом
     */
    public function getDisplayName(): string
    {
        $name = $this->name;

        // Префикс админа
        if ($this->is_admin && $this->admin_prefix) {
            $name = $this->admin_prefix . ' ' . $name;
        }

        // VIP бейдж
        if ($this->isVip()) {
            $name .= ' ⭐';
        }

        return $name;
    }

    /**
     * Отправить уведомление о восстановлении пароля
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
