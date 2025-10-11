<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GameItem;

class ItemController extends Controller
{
    public function index(Request $request, $category)
    {
        $game = $request->input('game');

        if (!$game) {
            return response()->json([]);
        }

        // Определяем тип предмета по категории
        $type = $this->getCategoryType($category);

        if (!$type) {
            return response()->json([]);
        }

        // Загружаем предметы из GameItem
        $items = GameItem::where('type', $type)
            ->where(function($query) use ($game) {
                $query->where('game', $game)
                      ->orWhereJsonContains('games', $game);
            })
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get(['id', 'name', 'image', 'description', 'rarity', 'type']);

        return response()->json($items);
    }

    /**
     * Получить игровые предметы (для GuideItemSelector)
     */
    public function getGameItems(Request $request)
    {
        $type = $request->input('type');
        $game = $request->input('game');

        if (!$game || !$type) {
            return response()->json(['items' => []]);
        }

        // Загружаем предметы из GameItem
        $items = GameItem::where('type', $type)
            ->where(function($query) use ($game) {
                $query->where('game', $game)
                      ->orWhereJsonContains('games', $game);
            })
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get(['id', 'name', 'image', 'description', 'rarity', 'type', 'game', 'games']);

        return response()->json(['items' => $items]);
    }

    /**
     * Преобразует категорию URL в тип предмета
     */
    private function getCategoryType($category)
    {
        $categoryMap = [
            'weapons' => 'weapon',
            'wonder-weapons' => 'wonder_weapon',
            'special-weapons' => 'special_weapon',
            'perks' => 'perk',
            'gums' => 'gum',
            'elixirs' => 'elixir',
            'field-upgrades' => 'field_upgrade',
            'talismans' => 'talisman',
        ];

        return $categoryMap[$category] ?? null;
    }
}
