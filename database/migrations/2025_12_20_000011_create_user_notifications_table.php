<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('notification_id')->nullable()->constrained('notifications')->nullOnDelete(); // Для массовых
            $table->string('type'); // Тип уведомления
            $table->string('title'); // Заголовок
            $table->text('message'); // Текст
            $table->json('data')->nullable(); // Дополнительные данные
            $table->boolean('is_read')->default(false); // Прочитано
            $table->timestamp('read_at')->nullable(); // Когда прочитано
            $table->boolean('sent_to_telegram')->default(false); // Отправлено в Telegram
            $table->timestamp('telegram_sent_at')->nullable(); // Когда отправлено в Telegram
            $table->timestamps();
            
            $table->index(['user_id', 'is_read']);
            $table->index(['user_id', 'created_at']);
            $table->index('type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_notifications');
    }
};

