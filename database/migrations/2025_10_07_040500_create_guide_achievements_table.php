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
        Schema::create('guide_achievements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('zombie_guide_id')->constrained('zombie_guides')->onDelete('cascade');
            $table->timestamp('completed_at')->useCurrent();
            $table->timestamps();

            // Уникальность: один пользователь может получить ачивку за гайд только один раз
            $table->unique(['user_id', 'zombie_guide_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guide_achievements');
    }
};
