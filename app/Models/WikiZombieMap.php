<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class WikiZombieMap extends Model
{
    protected $fillable = [
        'game',
        'slug',
        'name',
        'description',
        'story',
        'background_image',
        'thumbnail',
        'images',
        'release_date',
        'dlc_pack',
        'features',
        'easter_eggs',
        'perks',
        'weapons',
        'characters',
        'tips',
        'sort_order',
        'is_published',
    ];

    protected $casts = [
        'images' => 'array',
        'features' => 'array',
        'easter_eggs' => 'array',
        'perks' => 'array',
        'weapons' => 'array',
        'characters' => 'array',
        'is_published' => 'boolean',
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
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeForGame($query, $game)
    {
        return $query->where('game', $game);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    // Accessors
    public function getBackgroundImageUrlAttribute()
    {
        return $this->background_image ? asset('storage/' . $this->background_image) : null;
    }

    public function getThumbnailUrlAttribute()
    {
        return $this->thumbnail ? asset('storage/' . $this->thumbnail) : null;
    }

    public function getImageUrlsAttribute()
    {
        if (!$this->images || !is_array($this->images)) {
            return [];
        }

        return array_map(function ($image) {
            return asset('storage/' . $image);
        }, $this->images);
    }
}
