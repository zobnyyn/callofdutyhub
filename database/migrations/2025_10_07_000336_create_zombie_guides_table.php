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
        Schema::create('zombie_guides', function (Blueprint $table) {
            $table->id();
            $table->string('game'); // World at War, Black Ops, etc.
            $table->string('map_name'); // Nacht der Untoten, Der Riese, etc.
            $table->string('map_slug'); // URL-friendly название (убрали unique)
            $table->string('title'); // Заголовок гайда
            $table->text('description')->nullable(); // Краткое описание
            $table->longText('content'); // Основной контент гайда
            $table->string('image')->nullable(); // Изображение карты
            $table->boolean('is_published')->default(false); // Опубликован ли гайд
            $table->integer('views')->default(0); // Количество просмотров
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Автор
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zombie_guides');
    }
};
