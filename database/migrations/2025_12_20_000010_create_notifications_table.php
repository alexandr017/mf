<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // Тип уведомления: mass, rating_increased, referral_success, game_reminder_24h, game_reminder_1h, game_completed, etc.
            $table->string('title'); // Заголовок уведомления
            $table->text('message'); // Текст уведомления
            $table->json('data')->nullable(); // Дополнительные данные (JSON)
            $table->foreignId('created_by_user_id')->nullable()->constrained('users')->nullOnDelete(); // Кто создал (для массовых)
            $table->boolean('is_mass')->default(false); // Массовое уведомление
            $table->timestamp('scheduled_at')->nullable(); // Запланированная отправка
            $table->timestamps();
            
            $table->index('type');
            $table->index('is_mass');
            $table->index('scheduled_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};

