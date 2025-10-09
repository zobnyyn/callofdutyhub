<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class GameItem extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'type',
        'game',
        'games', // Добавляем массив игр
        'rarity',
        'description',
        'image',
        'icon',
        'properties',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'properties' => 'array',
        'games' => 'array', // Добавляем приведение к массиву
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    // Автоматическое создание slug при сохранении
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($item) {
            if (empty($item->slug)) {
                $item->slug = static::generateUniqueSlug($item->name, $item->games ?? []);
            }
        });

        static::updating(function ($item) {
            // При обновлении пересоздаем slug если изменилось имя или игры
            if ($item->isDirty('name') || $item->isDirty('games')) {
                $item->slug = static::generateUniqueSlug($item->name, $item->games ?? [], $item->id);
            }
        });
    }

    /**
     * Генерирует уникальный slug с учетом игр
     */
    protected static function generateUniqueSlug($name, $games = [], $excludeId = null)
    {
        $baseSlug = Str::slug($name);
        $slug = $baseSlug;
        $counter = 1;

        // Проверяем уникальность slug
        while (true) {
            $query = static::where('slug', $slug);

            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }

            if (!$query->exists()) {
                break;
            }

            // Если slug занят, добавляем счетчик
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    // Scope для фильтрации по типу
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Scope для активных предметов
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope для сортировки
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    // Scope для фильтрации по игре (поддержка старого поля game и нового games)
    public function scopeForGame($query, $game)
    {
        return $query->where(function ($q) use ($game) {
            $q->where('game', $game)
              ->orWhereJsonContains('games', $game);
        });
    }

    // Проверить, доступен ли предмет в указанной игре
    public function isAvailableInGame($game)
    {
        // Проверяем старое поле game
        if ($this->game === $game) {
            return true;
        }

        // Проверяем новое поле games (массив)
        if (is_array($this->games) && in_array($game, $this->games)) {
            return true;
        }

        return false;
    }

    // Получить список всех игр, в которых доступен предмет
    public function getAvailableGamesAttribute()
    {
        $gamesArray = [];

        // Добавляем из старого поля game
        if ($this->game) {
            $gamesArray[] = $this->game;
        }

        // Добавляем из нового поля games
        if (is_array($this->games)) {
            $gamesArray = array_merge($gamesArray, $this->games);
        }

        // Убираем дубликаты и возвращаем
        return array_values(array_unique($gamesArray));
    }

    // Получить полный URL изображения
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    // Получить полный URL иконки
    public function getIconUrlAttribute()
    {
        return $this->icon ? asset('storage/' . $this->icon) : null;
    }

    // Получить локализованное название типа
    public function getTypeNameAttribute()
    {
        return match($this->type) {
            'weapon' => 'Оружие',
            'perk' => 'Перк',
            'gum' => 'Жвачка',
            default => $this->type,
        };
    }

    // Получить локализованное название редкости
    public function getRarityNameAttribute()
    {
        if (!$this->rarity) {
            return null;
        }

        return match($this->rarity) {
            'rare' => 'Редкая',
            'epic' => 'Эпическая',
            'legendary' => 'Легендарная',
            'ultra' => 'Ультра',
            'whimsical' => 'Причудливая',
            default => $this->rarity,
        };
    }

    // Получить цвет редкости
    public function getRarityColorAttribute()
    {
        if (!$this->rarity) {
            return null;
        }

        return match($this->rarity) {
            'rare' => '#3b82f6', // синий
            'epic' => '#a855f7', // фиолетовый
            'legendary' => '#f59e0b', // ярко оранжевый/желтоватый
            'ultra' => '#dc2626', // тёмно оранжевый/красный
            'whimsical' => 'linear-gradient(135deg, #10b981, #ef4444, #a855f7, #f59e0b)', // градиент
            default => '#gray',
        };
    }

    // Получить CSS класс для редкости
    public function getRarityCssClassAttribute()
    {
        if (!$this->rarity) {
            return '';
        }

        return 'rarity-' . $this->rarity;
    }

    // Связь с гайдами
    public function guides()
    {
        return $this->belongsToMany(ZombieGuide::class, 'game_item_zombie_guide')
            ->withPivot('category', 'sort_order')
            ->withTimestamps();
    }
}
