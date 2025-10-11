<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWikiWeaponsTable extends Migration
{
    public function up(): void
    {
        Schema::create('wiki_weapons', function (Blueprint $table) {
            $table->id();
            $table->string('game'); // world-at-war, black-ops, etc.
            $table->string('slug');
            $table->string('name');
            $table->string('category'); // assault, rifle, sniper, etc.
            $table->text('description')->nullable();
            $table->string('image')->nullable(); // основное изображение
            $table->string('icon')->nullable(); // иконка
            $table->json('stats')->nullable(); // урон, скорострельность и т.д.
            $table->json('attachments')->nullable(); // доступные модификации
            $table->json('availability')->nullable(); // где доступно (мультиплеер, зомби, кампания)
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['game', 'category']);
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wiki_weapons');
    }
}
