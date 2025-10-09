<?php

namespace App\Http\Controllers;

use App\Models\ZombieGuide;
use App\Models\GuideAchievement;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

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
            ->with(['user', 'items'])
            ->findOrFail($id);

        // Увеличиваем счетчик просмотров
        $guide->increment('views');

        // Проверяем, есть ли у пользователя уже это достижение
        $hasAchievement = false;
        if (Auth::check()) {
            $hasAchievement = GuideAchievement::where('user_id', Auth::id())
                ->where('zombie_guide_id', $id)
                ->exists();
        }

        // Разделяем предметы по категориям
        $weapons = $guide->items->where('pivot.category', 'weapon')->values();
        $perks = $guide->items->where('pivot.category', 'perk')->values();
        $gums = $guide->items->where('pivot.category', 'gum')->values();

        return Inertia::render('ZombieGuides/ShowGuide', [
            'guide' => $guide,
            'hasAchievement' => $hasAchievement,
            'recommendedWeapons' => $weapons,
            'recommendedPerks' => $perks,
            'recommendedGums' => $gums,
        ]);
    }

    /**
     * Записать достижение за просмотр гайда
     */
    public function completeGuide(Request $request, $game, $mapSlug, $id)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $guide = ZombieGuide::where('game', $game)
            ->where('map_slug', $mapSlug)
            ->where('is_published', true)
            ->findOrFail($id);

        // Проверяем, дает ли этот гайд достижение
        if (!$guide->gives_achievement) {
            return response()->json([
                'message' => 'This guide does not grant an achievement',
                'success' => false
            ], 403);
        }

        // Пытаемся создать достижение (если уже есть - просто игнорируем)
        try {
            GuideAchievement::firstOrCreate([
                'user_id' => Auth::id(),
                'zombie_guide_id' => $guide->id,
            ]);

            return response()->json([
                'message' => 'Achievement unlocked!',
                'success' => true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Achievement already unlocked',
                'success' => false
            ]);
        }
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
            ],
            'Black Ops 4' => [
                'ix' => [
                    'name' => 'IX',
                    'description' => 'Gladiator Arena',
                    'image' => '/images/blackops4zombies/ix.jpg'
                ],
                'blood-of-the-dead' => [
                    'name' => 'Blood of the Dead',
                    'description' => 'Alcatraz Penitentiary',
                    'image' => '/images/blackops4zombies/bloodofthedead.jpg'
                ],
                'voyage-of-despair' => [
                    'name' => 'Voyage of Despair',
                    'description' => 'Titanic',
                    'image' => '/images/blackops4zombies/voyageofdespair.jpg'
                ],
                'classified' => [
                    'name' => 'Classified',
                    'description' => 'Pentagon',
                    'image' => '/images/blackops4zombies/classified.jpg'
                ],
                'dead-of-the-night' => [
                    'name' => 'Dead of the Night',
                    'description' => 'Alistair\'s Mansion',
                    'image' => '/images/blackops4zombies/deadofthenight.jpg'
                ],
                'ancient-evil' => [
                    'name' => 'Ancient Evil',
                    'description' => 'Delphi',
                    'image' => '/images/blackops4zombies/ancientevil.jpg'
                ],
                'alpha-omega' => [
                    'name' => 'Alpha Omega',
                    'description' => 'Broken Arrow Facility',
                    'image' => '/images/blackops4zombies/alphaomega.jpg'
                ],
                'tag-der-toten' => [
                    'name' => 'Tag der Toten',
                    'description' => 'Siberia',
                    'image' => '/images/blackops4zombies/tagdertoten.jpg'
                ]
            ],
            'Cold War' => [
                'die-maschine' => [
                    'name' => 'Die Maschine',
                    'description' => 'Nacht der Untoten Facility',
                    'image' => '/images/blackopscoldwarzombies/diemashin.jpg'
                ],
                'firebase-z' => [
                    'name' => 'Firebase Z',
                    'description' => 'Outpost 25',
                    'image' => '/images/blackopscoldwarzombies/firebazez.jpg'
                ],
                'outbreak' => [
                    'name' => 'Outbreak',
                    'description' => 'Open World',
                    'image' => '/images/blackopscoldwarzombies/outbreak.jpg'
                ],
                'mauer-der-toten' => [
                    'name' => 'Mauer der Toten',
                    'description' => 'Berlin',
                    'image' => '/images/blackopscoldwarzombies/mauerdertoten.jpg'
                ],
                'forsaken' => [
                    'name' => 'Forsaken',
                    'description' => 'Abandoned Mall',
                    'image' => '/images/blackopscoldwarzombies/forsaken.jpg'
                ]
            ],
            'Black Ops 6' => [
                'liberty-falls' => [
                    'name' => 'Liberty Falls',
                    'description' => 'West Virginia Town',
                    'image' => '/images/blackops6zombies/libertyfalls.jpg'
                ],
                'terminus' => [
                    'name' => 'Terminus',
                    'description' => 'Philippine Sea Prison',
                    'image' => '/images/blackops6zombies/terminus.jpg'
                ],
                'citadelle-des-morts' => [
                    'name' => 'Citadelle des Morts',
                    'description' => 'Medieval Castle',
                    'image' => '/images/blackops6zombies/citadelledesmorts.jpg'
                ],
                'the-tomb' => [
                    'name' => 'The Tomb',
                    'description' => 'Ancient Egypt',
                    'image' => '/images/blackops6zombies/tomb.jpg'
                ],
                'shattered-veil' => [
                    'name' => 'Shattered Veil',
                    'description' => 'Dimensional Rift',
                    'image' => '/images/blackops6zombies/shatteredveil.jpg'
                ],
                'reckoning' => [
                    'name' => 'Reckoning',
                    'description' => 'Final Battle',
                    'image' => '/images/blackops6zombies/reckoning.jpg'
                ]
            ],
            'Black Ops 7' => [
                'ashes-of-the-damned' => [
                    'name' => 'Ashes of the Damned',
                    'description' => 'Infernal Wasteland',
                    'image' => '/images/blackops7zombies/ashesofthedeamnt.jpg'
                ]
            ]
        ];

        return $maps[$game][$mapSlug] ?? null;
    }
}
