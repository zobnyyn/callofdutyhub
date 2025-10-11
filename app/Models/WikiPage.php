<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class WikiPage extends Model
{
    protected $fillable = [
        'game',
        'slug',
        'title',
        'short_description',
        'content',
        'background_image',
        'thumbnail',
        'meta_data',
        'sort_order',
        'is_published',
    ];

    protected $casts = [
        'content' => 'array',
        'meta_data' => 'array',
        'is_published' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($page) {
            if (empty($page->slug)) {
                $page->slug = Str::slug($page->game . '-' . $page->title);
            }
        });
    }

    // Связи
    public function weapons()
    {
        return $this->hasMany(WikiWeapon::class, 'game', 'game');
    }

    public function maps()
    {
        return $this->hasMany(WikiMap::class, 'game', 'game');
    }

    public function zombieMaps()
    {
        return $this->hasMany(WikiZombieMap::class, 'game', 'game');
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

    // Accessors
    public function getBackgroundImageUrlAttribute()
    {
        return $this->background_image ? asset('storage/' . $this->background_image) : null;
    }

    public function getThumbnailUrlAttribute()
    {
        return $this->thumbnail ? asset('storage/' . $this->thumbnail) : null;
    }
}

