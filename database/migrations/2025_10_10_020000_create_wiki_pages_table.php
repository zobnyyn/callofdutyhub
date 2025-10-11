<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWikiPagesTable extends Migration
{
    public function up(): void
    {
        Schema::create('wiki_pages', function (Blueprint $table) {
            $table->id();
            $table->string('game');
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('short_description')->nullable();
            $table->longText('content')->nullable();
            $table->string('background_image')->nullable();
            $table->string('thumbnail')->nullable();
            $table->json('meta_data')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();

            $table->index('game');
            $table->index('is_published');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wiki_pages');
    }
}

