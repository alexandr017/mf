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
        Schema::create('game_match_predictions_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('match_id')->constrained('game_match_predictions')->cascadeOnDelete();
            $table->enum('prediction', ['team_1', 'draw', 'team_2'])->comment('Прогноз: победа команды 1, ничья, победа команды 2');
            $table->boolean('is_correct')->nullable()->comment('Был ли прогноз правильным (заполняется после матча)');
            $table->decimal('rating_earned', 8, 3)->default(0)->comment('Начисленные баллы рейтинга');
            $table->timestamps();
            
            $table->unique(['user_id', 'match_id']);
            $table->index(['match_id', 'is_correct']);
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_match_predictions_users');
    }
};

