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
        Schema::table('zombie_guides', function (Blueprint $table) {
            $table->dropColumn('map_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('zombie_guides', function (Blueprint $table) {
            $table->string('map_name')->after('game');
        });
    }
};
