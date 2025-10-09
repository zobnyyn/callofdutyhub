<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('game_items', function (Blueprint $table) {
            // Добавляем поле game для хранения названия игры
            $table->string('game')->nullable()->after('type');
            $table->index('game');
        });

        // Удаляем старое поле games (JSON)
        Schema::table('game_items', function (Blueprint $table) {
            $table->dropColumn('games');
        });

        // Изменяем уникальность slug: теперь slug+game должны быть уникальными
        Schema::table('game_items', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->unique(['slug', 'game']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('game_items', function (Blueprint $table) {
            $table->dropUnique(['slug', 'game']);
            $table->unique(['slug']);
        });

        Schema::table('game_items', function (Blueprint $table) {
            $table->json('games')->nullable();
        });

        Schema::table('game_items', function (Blueprint $table) {
            $table->dropColumn('game');
        });
    }
};

