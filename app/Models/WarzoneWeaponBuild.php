<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WarzoneWeaponBuild extends Model
{
    protected $fillable = [
        'warzone_weapon_id',
        'title',
        'role',
        'notes',
        'tier_override',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'warzone_weapon_id' => 'integer',
    ];

    // Связи
    public function weapon(): BelongsTo
    {
        return $this->belongsTo(WarzoneWeapon::class, 'warzone_weapon_id');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(WarzoneWeaponBuildAttachment::class)->orderBy('sort_order');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Получить tier (с учетом override)
    public function getEffectiveTier()
    {
        return $this->tier_override ?? $this->weapon->tier;
    }
}

