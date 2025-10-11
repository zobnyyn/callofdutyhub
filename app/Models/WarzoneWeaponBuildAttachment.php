<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WarzoneWeaponBuildAttachment extends Model
{
    protected $fillable = [
        'warzone_weapon_build_id',
        'slot',
        'name',
        'stat_mods',
        'sort_order',
    ];

    protected $casts = [
        'stat_mods' => 'array',
        'sort_order' => 'integer',
        'warzone_weapon_build_id' => 'integer',
    ];

    // Связи
    public function build(): BelongsTo
    {
        return $this->belongsTo(WarzoneWeaponBuild::class, 'warzone_weapon_build_id');
    }
}
