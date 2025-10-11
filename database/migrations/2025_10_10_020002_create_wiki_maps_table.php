<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWikiMapsTable extends Migration
{
    public function up(): void
    {
        Schema::create('wiki_maps', function (Blueprint $table) {
            $table->id();
            $table->string('game'); // world-at-war, black-ops, etc.
            $table->string('slug');
            $table->string('name');
            $table->string('type')->default('multiplayer'); // multiplayer, zombie, campaign
            $table->text('description')->nullable();
            $table->string('image')->nullable(); // скриншот карты
            $table->string('minimap')->nullable(); // мини-карта
            $table->json('game_modes')->nullable(); // доступные режимы
            $table->string('location')->nullable(); // локация в мире
            $table->text('tips')->nullable(); // советы по карте
            $table->json('meta_data')->nullable(); // размер, год выхода, DLC и т.д.
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['game', 'type']);
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wiki_maps');
    }
}
