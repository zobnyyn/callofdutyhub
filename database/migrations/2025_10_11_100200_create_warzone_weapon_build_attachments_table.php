<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('warzone_weapon_build_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warzone_weapon_build_id')->constrained('warzone_weapon_builds')->cascadeOnDelete();
            $table->string('slot');
            $table->string('name');
            $table->json('stat_mods')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->index(['warzone_weapon_build_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('warzone_weapon_build_attachments');
    }
};


