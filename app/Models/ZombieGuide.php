<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ZombieGuide extends Model
{
    protected $fillable = [
        'game',
        'map_slug',
        'title',
        'description',
        'content',
        'image',
        'is_published',
        'views',
        'user_id'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'views' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(GameItem::class, 'game_item_zombie_guide')
            ->withPivot('category', 'sort_order')
            ->withTimestamps()
            ->orderBy('sort_order');
    }

    // Получить предметы по категориям
    public function getWeapons()
    {
        return $this->items()->wherePivot('category', 'weapon')->get();
    }

    public function getPerks()
    {
        return $this->items()->wherePivot('category', 'perk')->get();
    }

    public function getGums()
    {
        return $this->items()->wherePivot('category', 'gum')->get();
    }
}
