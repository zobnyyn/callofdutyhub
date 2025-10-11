<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWikiZombieMapsTable extends Migration
{
    public function up(): void
    {
        Schema::create('wiki_zombie_maps', function (Blueprint $table) {
            $table->id();
            $table->string('game');
            $table->string('slug');
            $table->string('name');
            $table->text('description')->nullable();
            $table->longText('story')->nullable();
            $table->string('background_image')->nullable();
            $table->string('thumbnail')->nullable();
            $table->json('images')->nullable();
            $table->string('release_date')->nullable();
            $table->string('dlc_pack')->nullable();
            $table->json('features')->nullable();
            $table->json('easter_eggs')->nullable();
            $table->json('perks')->nullable();
            $table->json('weapons')->nullable();
            $table->json('characters')->nullable();
            $table->text('tips')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();

            $table->index(['game', 'is_published']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wiki_zombie_maps');
    }
}
