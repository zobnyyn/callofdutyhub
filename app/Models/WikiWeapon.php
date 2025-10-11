<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class WikiWeapon extends Model
{
    protected $fillable = [
        'game',
        'slug',
        'name',
        'category',
        'description',
        'image',
        'icon',
        'stats',
        'attachments',
        'availability',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'stats' => 'array',
        'attachments' => 'array',
        'availability' => 'array',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($weapon) {
            if (empty($weapon->slug)) {
                $weapon->slug = Str::slug($weapon->game . '-' . $weapon->name);
            }
        });
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeForGame($query, $game)
    {
        return $query->where('game', $game);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    // Accessors
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    public function getIconUrlAttribute()
    {
        return $this->icon ? asset('storage/' . $this->icon) : null;
    }

    // Категории оружия
    public static function getCategories()
    {
        return [
            'assault_rifle' => 'Штурмовые винтовки',
            'rifle' => 'Винтовки',
            'lmg' => 'Пулемёты',
            'sniper' => 'Снайперские',
            'shotgun' => 'Дробовики',
            'pistol' => 'Пистолеты',
            'launcher' => 'Гранатомёты',
            'melee' => 'Холодное оружие',
        ];
    }
}

