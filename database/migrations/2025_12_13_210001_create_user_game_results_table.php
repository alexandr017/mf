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
        Schema::create('user_game_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('game_id')->constrained('games')->cascadeOnDelete();
            $table->integer('score')->default(0);
            $table->integer('rating_points_earned')->default(0);
            $table->boolean('win')->default(false);
            $table->timestamp('played_at')->useCurrent();
            $table->timestamps();
            
            $table->index(['user_id', 'played_at']);
            $table->index(['game_id', 'played_at']);
            $table->index('win');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_game_results');
    }
};


