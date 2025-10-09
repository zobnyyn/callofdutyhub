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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Кому предназначено уведомление
            $table->foreignId('from_user_id')->nullable()->constrained('users')->onDelete('cascade'); // От кого уведомление
            $table->string('type'); // friend_request, friend_accepted, etc.
            $table->text('message'); // Текст уведомления
            $table->json('data')->nullable(); // Дополнительные данные
            $table->boolean('read')->default(false); // Прочитано ли
            $table->timestamps();

            // Индексы
            $table->index(['user_id', 'read']);
            $table->index('type');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};

