<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Переносим данные из поля game в поле games (массив)
        $items = DB::table('game_items')->whereNotNull('game')->get();

        foreach ($items as $item) {
            $gamesArray = [];

            // Если уже есть данные в games, декодируем их
            if ($item->games) {
                $gamesArray = json_decode($item->games, true) ?? [];
            }

            // Добавляем значение из поля game, если его еще нет в массиве
            if ($item->game && !in_array($item->game, $gamesArray)) {
                $gamesArray[] = $item->game;
            }

            // Обновляем запись
            if (!empty($gamesArray)) {
                DB::table('game_items')
                    ->where('id', $item->id)
                    ->update(['games' => json_encode($gamesArray)]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // При откате очищаем поле games
        DB::table('game_items')->update(['games' => null]);
    }
};

