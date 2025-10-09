<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('guide_achievements', function (Blueprint $table) {
            $table->integer('display_order')->nullable()->after('completed_at');
            $table->index('display_order');
        });
    }

    public function down(): void
    {
        Schema::table('guide_achievements', function (Blueprint $table) {
            $table->dropIndex(['display_order']);
            $table->dropColumn('display_order');
        });
    }
};

