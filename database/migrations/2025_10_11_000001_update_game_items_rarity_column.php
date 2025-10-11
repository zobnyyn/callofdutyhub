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
        // Изменяем поле rarity, чтобы оно поддерживало все возможные редкости
        // Для жвачек и элексиров: rare, epic, legendary, ultra, whimsical
        // Для талисманов: common, rare, legendary, epic

        DB::statement("ALTER TABLE game_items MODIFY COLUMN rarity VARCHAR(50) NULL COMMENT 'Редкость предмета: common, rare, epic, legendary, ultra, whimsical'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Возвращаем обратно к обычному varchar без комментария
        DB::statement("ALTER TABLE game_items MODIFY COLUMN rarity VARCHAR(255) NULL");
    }
};

