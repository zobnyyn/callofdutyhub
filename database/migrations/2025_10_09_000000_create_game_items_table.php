<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('game_items', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Название предмета
            $table->string('slug')->unique(); // URL-friendly название
            $table->enum('type', ['weapon', 'perk', 'gum']); // Тип: оружие, перк, жвачка
            $table->string('game')->nullable(); // Игра (Black Ops 3, Cold War и т.д.)
            $table->string('rarity')->nullable(); // Редкость (Common, Rare, Epic, Legendary)
            $table->text('description')->nullable(); // Описание
            $table->string('image')->nullable(); // Путь к изображению
            $table->string('icon')->nullable(); // Путь к иконке (опционально)
            $table->json('games')->nullable(); // В каких играх доступен
            $table->json('properties')->nullable(); // Дополнительные свойства (урон, эффекты и т.д.)
            $table->integer('sort_order')->default(0); // Порядок сортировки
            $table->boolean('is_active')->default(true); // Активен ли предмет
            $table->timestamps();

            $table->index('type');
            $table->index('game');
            $table->index('is_active');
            $table->index('sort_order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('game_items');
    }
};
