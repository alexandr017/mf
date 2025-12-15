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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('game_id')->nullable()->constrained('games')->nullOnDelete();
            $table->foreignId('match_id')->nullable()->constrained('tournaments_matches')->nullOnDelete();
            $table->integer('points'); // Может быть отрицательным для списания
            $table->enum('type', ['earn', 'spend']); // Начисление или списание
            $table->string('description')->nullable();
            $table->text('details')->nullable(); // Дополнительная информация
            $table->timestamps();
            
            $table->index(['user_id', 'created_at']);
            $table->index('type');
            $table->index(['game_id', 'created_at']);
            $table->index(['match_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

