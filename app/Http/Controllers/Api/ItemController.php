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

        // Создаём карту соответствия старого формата к новому
        $gameMap = [
            'world-at-war' => 'World at War',
            'black-ops' => 'Black Ops',
            'black-ops-2' => 'Black Ops 2',
            'black-ops-3' => 'Black Ops 3',
            'black-ops-4' => 'Black Ops 4',
            'cold-war' => 'Cold War',
            'black-ops-6' => 'Black Ops 6',
            'black-ops-7' => 'Black Ops 7',
        ];

        $oldGameFormat = $gameMap[$game] ?? $game;

        // Загружаем предметы из GameItem
        // Ищем по:
        // 1. Точному совпадению с новым форматом (black-ops-3)
        // 2. Точному совпадению со старым форматом (Black Ops 3)
        // 3. В JSON массиве games (новый формат)
        // 4. В JSON массиве games (старый формат)
        $items = GameItem::where('type', $type)
            ->where(function($query) use ($game, $oldGameFormat) {
                $query->where('game', $game)
                      ->orWhere('game', $oldGameFormat)
                      ->orWhereJsonContains('games', $game)
                      ->orWhereJsonContains('games', $oldGameFormat);
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

        if (!$type) {
            return response()->json(['items' => []]);
        }

        // Если игра не указана, возвращаем все предметы данного типа
        if (!$game) {
            $items = GameItem::where('type', $type)
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get(['id', 'name', 'image', 'description', 'rarity', 'type', 'game', 'games']);

            return response()->json(['items' => $items]);
        }

        // Создаём карту соответствия старого формата к новому
        $gameMap = [
            'world-at-war' => 'World at War',
            'black-ops' => 'Black Ops',
            'black-ops-2' => 'Black Ops 2',
            'black-ops-3' => 'Black Ops 3',
            'black-ops-4' => 'Black Ops 4',
            'cold-war' => 'Cold War',
            'black-ops-6' => 'Black Ops 6',
            'black-ops-7' => 'Black Ops 7',
        ];

        $oldGameFormat = $gameMap[$game] ?? $game;

        // Загружаем предметы из GameItem
        // Ищем по:
        // 1. Точному совпадению с новым форматом (black-ops-3)
        // 2. Точному совпадению со старым форматом (Black Ops 3)
        // 3. В JSON массиве games (новый формат)
        // 4. В JSON массиве games (старый формат)
        $items = GameItem::where('type', $type)
            ->where(function($query) use ($game, $oldGameFormat) {
                $query->where('game', $game)
                      ->orWhere('game', $oldGameFormat)
                      ->orWhereJsonContains('games', $game)
                      ->orWhereJsonContains('games', $oldGameFormat);
            })
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get(['id', 'name', 'image', 'description', 'rarity', 'type', 'game', 'games']);

        // Добавляем поле available_games для отображения
        $items = $items->map(function($item) {
            if ($item->games && is_array($item->games)) {
                $item->available_games = $item->games;
            } elseif ($item->game) {
                $item->available_games = [$item->game];
            } else {
                $item->available_games = [];
            }
            return $item;
        });

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
