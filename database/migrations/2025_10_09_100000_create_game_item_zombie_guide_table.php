<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('game_item_zombie_guide', function (Blueprint $table) {
            $table->id();
            $table->foreignId('zombie_guide_id')->constrained()->onDelete('cascade');
            $table->foreignId('game_item_id')->constrained()->onDelete('cascade');
            $table->string('category'); // weapon, perk, gum - для группировки
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->unique(['zombie_guide_id', 'game_item_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('game_item_zombie_guide');
    }
};

