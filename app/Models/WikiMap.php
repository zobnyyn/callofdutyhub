<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class WikiMap extends Model
{
    protected $fillable = [
        'game',
        'slug',
        'name',
        'type',
        'description',
        'image',
        'minimap',
        'game_modes',
        'location',
        'tips',
        'meta_data',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'game_modes' => 'array',
        'meta_data' => 'array',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($map) {
            if (empty($map->slug)) {
                $map->slug = Str::slug($map->game . '-' . $map->name);
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

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
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

    public function getMinimapUrlAttribute()
    {
        return $this->minimap ? asset('storage/' . $this->minimap) : null;
    }
}

