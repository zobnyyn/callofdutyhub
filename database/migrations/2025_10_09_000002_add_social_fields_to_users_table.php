<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('telegram')->nullable();
            $table->string('discord')->nullable();
            $table->string('xbox')->nullable();
            $table->string('steam')->nullable();
            $table->string('psn')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['telegram', 'discord', 'xbox', 'steam', 'psn']);
        });
    }
};

