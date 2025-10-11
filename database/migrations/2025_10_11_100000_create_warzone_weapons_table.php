<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('warzone_weapons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->enum('tier', ['imba_patch','meta','normal','avoid']);
            $table->enum('origin_game', ['mw2022','mw2023','bo6']);
            $table->enum('category', ['ar','smg','lmg','marksman','sniper','shotgun','pistol','launcher','melee','tactical','battlerifle']);
            $table->json('categories')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('popularity')->default(0);
            $table->integer('sort_order')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            $table->index(['tier','origin_game','category','is_active']);
            $table->index(['sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('warzone_weapons');
    }
};

