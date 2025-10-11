<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WikiPage;

class WikiPagesSeeder extends Seeder
{
    public function run()
    {
        $games = [
            [
                'game' => 'world-at-war',
                'slug' => 'world-at-war-wiki',
                'title' => 'Call of Duty: World at War',
                'short_description' => 'Шутер от первого лица во время Второй мировой войны. Первая игра с режимом Nazi Zombies.',
                'content' => json_encode([
                    'weapons' => [],
                    'maps' => [],
                    'zombie_maps' => []
                ]),
                'is_published' => true,
                'sort_order' => 1,
            ],
            [
                'game' => 'black-ops',
                'slug' => 'black-ops-wiki',
                'title' => 'Call of Duty: Black Ops',
                'short_description' => 'Действие происходит во время Холодной войны. Культовый зомби-режим с легендарными картами.',
                'content' => json_encode([
                    'weapons' => [],
                    'maps' => [],
                    'zombie_maps' => []
                ]),
                'is_published' => true,
                'sort_order' => 2,
            ],
            [
                'game' => 'black-ops-2',
                'slug' => 'black-ops-2-wiki',
                'title' => 'Call of Duty: Black Ops II',
                'short_description' => 'Футуристический шутер с нелинейным сюжетом. Действие в 1980-х и 2025 году.',
                'content' => json_encode([
                    'weapons' => [],
                    'maps' => [],
                    'zombie_maps' => []
                ]),
                'is_published' => true,
                'sort_order' => 3,
            ],
            [
                'game' => 'black-ops-3',
                'slug' => 'black-ops-3-wiki',
                'title' => 'Call of Duty: Black Ops III',
                'short_description' => 'Футуристический шутер с киберпанк-элементами. Действие в 2065 году.',
                'content' => json_encode([
                    'weapons' => [],
                    'maps' => [],
                    'zombie_maps' => []
                ]),
                'is_published' => true,
                'sort_order' => 4,
            ],
            [
                'game' => 'black-ops-4',
                'slug' => 'black-ops-4-wiki',
                'title' => 'Call of Duty: Black Ops 4',
                'short_description' => 'Мультиплеерный шутер с расширенным зомби-режимом и режимом Battle Royale.',
                'content' => json_encode([
                    'weapons' => [],
                    'maps' => [],
                    'zombie_maps' => []
                ]),
                'is_published' => true,
                'sort_order' => 5,
            ],
            [
                'game' => 'cold-war',
                'slug' => 'cold-war-wiki',
                'title' => 'Call of Duty: Black Ops Cold War',
                'short_description' => 'Возвращение к истокам Холодной войны с обновленным зомби-режимом Dark Aether.',
                'content' => json_encode([
                    'weapons' => [],
                    'maps' => [],
                    'zombie_maps' => []
                ]),
                'is_published' => true,
                'sort_order' => 6,
            ],
            [
                'game' => 'black-ops-6',
                'slug' => 'black-ops-6-wiki',
                'title' => 'Call of Duty: Black Ops 6',
                'short_description' => 'Новейшая игра серии Black Ops с современными технологиями и зомби-режимом.',
                'content' => json_encode([
                    'weapons' => [],
                    'maps' => [],
                    'zombie_maps' => []
                ]),
                'is_published' => true,
                'sort_order' => 7,
            ],
        ];

        foreach ($games as $game) {
            WikiPage::updateOrCreate(
                ['game' => $game['game']],
                $game
            );
        }

        $this->command->info('Wiki pages created successfully!');
    }
}

