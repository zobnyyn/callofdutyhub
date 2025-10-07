<?php

namespace App\Console\Commands;

use App\Models\ZombieGuide;
use Illuminate\Console\Command;

class ListGuides extends Command
{
    protected $signature = 'guides:list';
    protected $description = 'Список всех гайдов';

    public function handle()
    {
        $guides = ZombieGuide::all();

        $this->info('Всего гайдов: ' . $guides->count());
        $this->newLine();

        foreach ($guides as $guide) {
            $this->line("ID: {$guide->id}");
            $this->line("Game: {$guide->game}");
            $this->line("Map Name: {$guide->map_name}");
            $this->line("Map Slug: {$guide->map_slug}");
            $this->line("Title: {$guide->title}");
            $this->line("Published: " . ($guide->is_published ? 'Да' : 'Нет'));
            $this->newLine();
        }

        return 0;
    }
}

