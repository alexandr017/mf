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
        Schema::create('friendly_matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_1')->constrained('teams');
            $table->foreignId('team_2')->constrained('teams');
            $table->dateTime('date');
            $table->tinyInteger('score_1')->nullable();
            $table->tinyInteger('score_2')->nullable();
            $table->enum('status', ['scheduled', 'played', 'cancelled'])->default('scheduled');
            $table->json('scorers')->nullable()->comment('JSON массив с бомбардирами: [{"user_id": 1, "goals": [{"minute": 15}, ...]}, ...]');
            $table->json('assists')->nullable()->comment('JSON массив с ассистентами: [{"user_id": 1, "assists": [{"minute": 15}, ...]}, ...]');
            $table->json('squad')->nullable()->comment('JSON с заявками: {"team_1": [{"user_id": 1, "start_minute": 0, "end_minute": 30}, ...], "team_2": [...]}');
            $table->timestamps();
            
            $table->index(['date', 'status']);
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('friendly_matches');
    }
};

