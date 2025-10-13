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
        Schema::create('game_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('creator_id')->constrained('users')->onDelete('cascade');
            $table->string('name'); // Название группы
            $table->text('description')->nullable(); // Описание группы
            $table->string('game'); // Какая игра (Warzone, Black Ops 6, и т.д.)
            $table->string('game_mode')->nullable(); // Режим игры (Multiplayer, Zombies, Warzone и т.д.)
            $table->string('platform')->nullable(); // Платформа (PC, Xbox, PlayStation, Cross-platform)
            $table->integer('max_members')->default(10); // Максимум участников
            $table->string('skill_level')->nullable(); // Уровень скилла (Новичок, Средний, Про)
            $table->string('language')->default('Русский'); // Язык общения
            $table->boolean('is_active')->default(true); // Активна ли группа
            $table->json('requirements')->nullable(); // Дополнительные требования
            $table->timestamps();

            $table->index(['game', 'game_mode', 'is_active']);
        });

        Schema::create('game_group_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_group_id')->constrained('game_groups')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['pending', 'accepted', 'declined'])->default('pending');
            $table->timestamp('joined_at')->nullable();
            $table->timestamps();

            $table->unique(['game_group_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_group_members');
        Schema::dropIfExists('game_groups');
    }
};
