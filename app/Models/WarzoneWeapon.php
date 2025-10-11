<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class WarzoneWeapon extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'tier',
        'origin_game',
        'category',
        'categories',
        'image',
        'description',
        'is_active',
        'popularity',
        'sort_order',
        'published_at',
    ];

    protected $casts = [
        'categories' => 'array',
        'is_active' => 'boolean',
        'popularity' => 'integer',
        'sort_order' => 'integer',
        'published_at' => 'datetime',
    ];

    // Автоматическое создание slug при сохранении
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($weapon) {
            if (empty($weapon->slug)) {
                $weapon->slug = static::generateUniqueSlug($weapon->name);
            }
        });

        static::updating(function ($weapon) {
            if ($weapon->isDirty('name')) {
                $weapon->slug = static::generateUniqueSlug($weapon->name, $weapon->id);
            }
        });
    }

    /**
     * Генерирует уникальный slug
     */
    protected static function generateUniqueSlug($name, $excludeId = null)
    {
        $baseSlug = Str::slug($name);
        $slug = $baseSlug;
        $counter = 1;

        while (true) {
            $query = static::where('slug', $slug);

            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }

            if (!$query->exists()) {
                break;
            }

            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    // Связи
    public function builds(): HasMany
    {
        return $this->hasMany(WarzoneWeaponBuild::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByTier($query, $tier)
    {
        if (is_array($tier)) {
            return $query->whereIn('tier', $tier);
        }
        return $query->where('tier', $tier);
    }

    public function scopeByOrigin($query, $origin)
    {
        if (is_array($origin)) {
            return $query->whereIn('origin_game', $origin);
        }
        return $query->where('origin_game', $origin);
    }

    public function scopeByCategory($query, $category)
    {
        if (is_array($category)) {
            return $query->whereIn('category', $category);
        }
        return $query->where('category', $category);
    }

    public function scopeSearch($query, $search)
    {
        if (empty($search)) {
            return $query;
        }

        return $query->where(function ($q) use ($search) {
            $q->where('name', 'LIKE', "%{$search}%")
              ->orWhere('description', 'LIKE', "%{$search}%");
        });
    }

    // Метод для получения веса tier (для сортировки)
    public static function getTierWeight($tier)
    {
        return match($tier) {
            'imba_patch' => 1,
            'meta' => 2,
            'normal' => 3,
            'avoid' => 4,
            default => 999,
        };
    }

    // Метод для получения названия tier
    public static function getTierLabel($tier)
    {
        return match($tier) {
            'imba_patch' => 'ИМБА ПАТЧА',
            'meta' => 'МЕТА',
            'normal' => 'НОРМИК',
            'avoid' => 'НЕ СТОИТ БРАТЬ',
            default => 'UNKNOWN',
        };
    }

    // Метод для получения названия origin_game
    public static function getOriginLabel($origin)
    {
        return match($origin) {
            'mw2022' => 'Modern Warfare II (2022)',
            'mw2023' => 'Modern Warfare III (2023)',
            'bo6' => 'Black Ops 6 (2024)',
            default => 'UNKNOWN',
        };
    }

    // Метод для получения названия категории
    public static function getCategoryLabel($category)
    {
        return match($category) {
            'ar' => 'Assault Rifle',
            'smg' => 'SMG',
            'lmg' => 'LMG',
            'marksman' => 'Marksman Rifle',
            'sniper' => 'Sniper Rifle',
            'shotgun' => 'Shotgun',
            'pistol' => 'Pistol',
            'launcher' => 'Launcher',
            'melee' => 'Melee',
            'tactical' => 'Tactical',
            'battlerifle' => 'Battle Rifle',
            default => ucfirst($category),
        };
    }
}
