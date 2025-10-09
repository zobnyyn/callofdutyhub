<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Устанавливаем gives_achievement = true для всех существующих гайдов
        DB::table('zombie_guides')->update(['gives_achievement' => true]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Откат не требуется
    }
};

