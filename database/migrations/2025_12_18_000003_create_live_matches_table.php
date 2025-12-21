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
        Schema::create('live_matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('match_id')->constrained('tournaments_matches')->cascadeOnDelete();
            $table->timestamp('started_at');
            $table->timestamp('ends_at');
            $table->enum('status', ['pending', 'live', 'finished'])->default('pending');
            $table->integer('score_1')->default(0);
            $table->integer('score_2')->default(0);
            $table->integer('current_minute')->default(0); // Текущая минута матча (0-15)
            $table->json('events')->nullable(); // События матча (голы, передачи) с временными метками
            $table->json('players_positions')->nullable(); // Позиции игроков на поле
            $table->boolean('result_saved')->default(false); // Флаг, что результат сохранен в основную таблицу
            $table->timestamps();
            
            $table->index(['status', 'started_at']);
            $table->index('match_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('live_matches');
    }
};

