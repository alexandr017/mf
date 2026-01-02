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
        Schema::create('game_penalty_training', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->enum('player_choice', ['left', 'center', 'right'])->comment('Выбор игрока: слева, по центру, справа');
            $table->enum('goalkeeper_choice', ['left', 'center', 'right'])->comment('Выбор вратаря: слева, по центру, справа');
            $table->boolean('is_goal')->default(false)->comment('Забил ли игрок');
            $table->decimal('rating_earned', 8, 3)->default(0)->comment('Начисленные баллы рейтинга');
            $table->integer('duration_seconds')->comment('Длительность выполнения в секундах');
            $table->string('ip_address', 45)->nullable()->comment('IP адрес для защиты от накрутки');
            $table->string('user_agent')->nullable()->comment('User Agent для защиты от накрутки');
            $table->timestamps();
            
            $table->index(['user_id', 'created_at']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_penalty_training');
    }
};

