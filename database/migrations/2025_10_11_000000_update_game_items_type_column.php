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
        // Изменяем тип поля type с enum на string для поддержки новых категорий
        DB::statement("ALTER TABLE game_items MODIFY COLUMN type VARCHAR(50) NOT NULL");

        // Можно также добавить комментарий для документации
        DB::statement("ALTER TABLE game_items MODIFY COLUMN type VARCHAR(50) NOT NULL COMMENT 'Тип предмета: weapon, wonder_weapon, special_weapon, perk, gum, elixir, field_upgrade, talisman'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Возвращаем обратно к enum (только если нет новых типов в БД)
        DB::statement("ALTER TABLE game_items MODIFY COLUMN type ENUM('weapon', 'perk', 'gum') NOT NULL");
    }
};

