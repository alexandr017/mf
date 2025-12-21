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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained('teams')->onDelete('cascade');
            $table->integer('games')->default(0)->comment('Игр');
            $table->integer('wins')->default(0)->comment('Побед');
            $table->integer('draws')->default(0)->comment('Ничьих');
            $table->integer('losses')->default(0)->comment('Поражений');
            $table->integer('goal_difference')->default(0)->comment('РМ - разница мячей');
            $table->integer('points')->default(0)->comment('Очки');
            $table->timestamps();
            
            $table->unique('team_id');
            $table->index('points');
            $table->index('goal_difference');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};


