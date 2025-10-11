<?php

namespace App\Http\Controllers;

use App\Models\WikiWeapon;
use App\Models\WikiMap;
use App\Models\WikiZombieMap;
use Illuminate\Http\Request;

class WikiController extends Controller
{
    // Получить все оружие для игры
    public function getWeapons($game)
    {
        $weapons = WikiWeapon::forGame($game)
            ->active()
            ->ordered()
            ->get()
            ->groupBy('category');

        return response()->json($weapons);
    }

    // Получить все карты для игры
    public function getMaps($game)
    {
        $maps = WikiMap::forGame($game)
            ->active()
            ->byType('multiplayer')
            ->ordered()
            ->get();

        return response()->json($maps);
    }

    // Получить все зомби-карты для игры
    public function getZombieMaps($game)
    {
        $maps = WikiZombieMap::forGame($game)
            ->published()
            ->ordered()
            ->get();

        return response()->json($maps);
    }

    // Получить одну зомби-карту по slug
    public function getZombieMap($game, $slug)
    {
        $map = WikiZombieMap::where('game', $game)
            ->where('slug', $slug)
            ->published()
            ->firstOrFail();

        return response()->json($map);
    }
}

