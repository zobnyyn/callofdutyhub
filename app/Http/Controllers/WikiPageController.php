<?php

namespace App\Http\Controllers;

use App\Models\WikiPage;
use App\Models\WikiWeapon;
use App\Models\WikiMap;
use App\Models\WikiZombieMap;
use Inertia\Inertia;

class WikiPageController extends Controller
{
    public function show($game)
    {
        // Находим Wiki-страницу для этой игры
        $page = WikiPage::where('game', $game)
            ->where('is_published', true)
            ->first();

        if (!$page) {
            abort(404, 'Wiki страница не найдена');
        }

        // Получаем выбранное оружие
        $weapons = [];
        if (!empty($page->content['weapons'])) {
            $weapons = WikiWeapon::whereIn('id', $page->content['weapons'])
                ->where('is_active', true)
                ->ordered()
                ->get();
        }

        // Получаем выбранные карты
        $maps = [];
        if (!empty($page->content['maps'])) {
            $maps = WikiMap::whereIn('id', $page->content['maps'])
                ->where('is_active', true)
                ->ordered()
                ->get();
        }

        // Получаем выбранные зомби-карты
        $zombieMaps = [];
        if (!empty($page->content['zombie_maps'])) {
            $zombieMaps = WikiZombieMap::whereIn('id', $page->content['zombie_maps'])
                ->where('is_published', true)
                ->ordered()
                ->get();
        }

        $component = $this->getComponentForGame($game);

        return Inertia::render($component, [
            'page' => $page,
            'weapons' => $weapons,
            'maps' => $maps,
            'zombieMaps' => $zombieMaps,
        ]);
    }

    private function getComponentForGame($game)
    {
        // Полное статическое сопоставление всех поддерживаемых игр
        $components = [
            // Black Ops / World at War
            'world-at-war' => 'WorldAtWarWiki',
            'black-ops' => 'BlackOpsWiki',
            'black-ops-2' => 'BlackOps2Wiki',
            'black-ops-3' => 'BlackOps3Wiki',
            'black-ops-4' => 'BlackOps4Wiki',
            'cold-war' => 'ColdWarWiki',
            'black-ops-6' => 'BlackOps6Wiki',

            // Modern Warfare (классическая трилогия + перезагрузка + новая трилогия)
            'cod4-modern-warfare' => 'ModernWarfare2007Wiki',
            'modern-warfare-2' => 'ModernWarfare2009Wiki', // оригинальный MW2 2009
            'modern-warfare-3' => 'ModernWarfare2011Wiki', // оригинальный MW3 2011
            'modern-warfare-2019' => 'ModernWarfare2019Wiki',
            'modern-warfare-2-2022' => 'ModernWarfare2022Wiki',
            'modern-warfare-3-2023' => 'ModernWarfare2023Wiki',
        ];

        return $components[$game] ?? 'WorldAtWarWiki';
    }
}
