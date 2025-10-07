<?php

namespace App\Http\Controllers;

use App\Models\ZombieGuide;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ZombieGuideController extends Controller
{
    /**
     * Показать все гайды для конкретной карты
     */
    public function showByMap($game, $mapSlug)
    {
        $guides = ZombieGuide::where('game', $game)
            ->where('map_slug', $mapSlug)
            ->where('is_published', true)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        // Получаем информацию о карте
        $mapInfo = $this->getMapInfo($game, $mapSlug);

        return Inertia::render('ZombieGuides/MapGuides', [
            'guides' => $guides,
            'game' => $game,
            'mapSlug' => $mapSlug,
            'mapInfo' => $mapInfo
        ]);
    }

    /**
     * Показать конкретный гайд
     */
    public function show($game, $mapSlug, $id)
    {
        $guide = ZombieGuide::where('game', $game)
            ->where('map_slug', $mapSlug)
            ->where('is_published', true)
            ->with('user')
            ->findOrFail($id);

        // Увеличиваем счетчик просмотров
        $guide->increment('views');

        return Inertia::render('ZombieGuides/ShowGuide', [
            'guide' => $guide
        ]);
    }

    /**
     * Получить информацию о карте
     */
    private function getMapInfo($game, $mapSlug)
    {
        $maps = [
            'World at War' => [
                'nacht-der-untoten' => [
                    'name' => 'Nacht der Untoten',
                    'description' => 'Night of the Undead',
                    'image' => '/images/worldatwarzombies/nachtderuntoten.jpg'
                ],
                'verruckt' => [
                    'name' => 'Verrückt',
                    'description' => 'Asylum',
                    'image' => '/images/worldatwarzombies/verruct.jpg'
                ],
                'shi-no-numa' => [
                    'name' => 'Shi No Numa',
                    'description' => 'Swamp of Death',
                    'image' => '/images/worldatwarzombies/shinonuma.jpg'
                ],
                'der-riese' => [
                    'name' => 'Der Riese',
                    'description' => 'The Giant',
                    'image' => '/images/worldatwarzombies/derrise.jpg'
                ]
            ],
            'Black Ops' => [
                'kino-der-toten' => [
                    'name' => 'Kino der Toten',
                    'description' => 'Theater of the Damned'
                ],
                'five' => [
                    'name' => '"Five"',
                    'description' => 'Pentagon'
                ],
                'ascension' => [
                    'name' => 'Ascension',
                    'description' => 'Soviet Cosmodrome'
                ],
                'call-of-the-dead' => [
                    'name' => 'Call of the Dead',
                    'description' => 'Siberian Outpost'
                ],
                'shangri-la' => [
                    'name' => 'Shangri-La',
                    'description' => 'Himalayan Jungle'
                ],
                'moon' => [
                    'name' => 'Moon',
                    'description' => 'Lunar Base'
                ]
            ],
            'Black Ops 2' => [
                'tranzit' => [
                    'name' => 'TranZit',
                    'description' => 'Green Run'
                ],
                'nuketown-zombies' => [
                    'name' => 'Nuketown Zombies',
                    'description' => 'Nuketown 2025'
                ],
                'die-rise' => [
                    'name' => 'Die Rise',
                    'description' => 'Great Leap Forward'
                ],
                'mob-of-the-dead' => [
                    'name' => 'Mob of the Dead',
                    'description' => 'Alcatraz Island'
                ],
                'buried' => [
                    'name' => 'Buried',
                    'description' => 'Resolution 1295'
                ],
                'origins' => [
                    'name' => 'Origins',
                    'description' => 'Apocalypse'
                ],
                'grief-cell-block' => [
                    'name' => 'Grief: Cell Block',
                    'description' => 'Alcatraz'
                ],
                'turned' => [
                    'name' => 'Turned',
                    'description' => 'Diner'
                ]
            ],
            'Black Ops 3' => [
                // Original Maps
                'shadows-of-evil' => [
                    'name' => 'Shadows of Evil',
                    'description' => 'Morg City'
                ],
                'the-giant' => [
                    'name' => 'The Giant',
                    'description' => 'Waffenfabrik Der Riese'
                ],
                'der-eisendrache' => [
                    'name' => 'Der Eisendrache',
                    'description' => 'The Iron Dragon'
                ],
                'zetsubou-no-shima' => [
                    'name' => 'Zetsubou No Shima',
                    'description' => 'Island of Despair'
                ],
                'gorod-krovi' => [
                    'name' => 'Gorod Krovi',
                    'description' => 'City of Blood'
                ],
                'revelations' => [
                    'name' => 'Revelations',
                    'description' => '"The House" Remains, Agartha'
                ],
                // Zombie Chronicles
                'bo3-nacht-der-untoten' => [
                    'name' => 'Nacht der Untoten',
                    'description' => 'Zombie Chronicles'
                ],
                'bo3-verruckt' => [
                    'name' => 'Verrückt',
                    'description' => 'Zombie Chronicles'
                ],
                'bo3-shi-no-numa' => [
                    'name' => 'Shi No Numa',
                    'description' => 'Zombie Chronicles'
                ],
                'bo3-kino-der-toten' => [
                    'name' => 'Kino der Toten',
                    'description' => 'Zombie Chronicles'
                ],
                'bo3-ascension' => [
                    'name' => 'Ascension',
                    'description' => 'Zombie Chronicles'
                ],
                'bo3-shangri-la' => [
                    'name' => 'Shangri-La',
                    'description' => 'Zombie Chronicles'
                ],
                'bo3-moon' => [
                    'name' => 'Moon',
                    'description' => 'Zombie Chronicles'
                ],
                'bo3-origins' => [
                    'name' => 'Origins',
                    'description' => 'Zombie Chronicles'
                ]
            ]
        ];

        return $maps[$game][$mapSlug] ?? null;
    }
}
