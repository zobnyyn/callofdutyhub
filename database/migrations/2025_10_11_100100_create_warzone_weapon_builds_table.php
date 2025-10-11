<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('warzone_weapon_builds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warzone_weapon_id')->constrained('warzone_weapons')->cascadeOnDelete();
            $table->string('title');
            $table->string('role')->nullable();
            $table->text('notes')->nullable();
            $table->enum('tier_override', ['imba_patch','meta','normal','avoid'])->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['warzone_weapon_id','is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('warzone_weapon_builds');
    }
};
