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
        Schema::create('game_match_predictions', function (Blueprint $table) {
            $table->id();
            $table->string('team_1_name')->comment('Название команды 1');
            $table->string('team_2_name')->comment('Название команды 2');
            $table->string('team_1_logo')->nullable()->comment('Логотип команды 1');
            $table->string('team_2_logo')->nullable()->comment('Логотип команды 2');
            $table->dateTime('match_date')->comment('Дата и время матча');
            $table->tinyInteger('score_1')->nullable()->comment('Счет команды 1 (после матча)');
            $table->tinyInteger('score_2')->nullable()->comment('Счет команды 2 (после матча)');
            $table->enum('status', ['scheduled', 'finished', 'cancelled'])->default('scheduled')->comment('Статус матча');
            $table->dateTime('prediction_deadline')->comment('Дедлайн для прогнозов (обычно за 1 час до матча)');
            $table->text('description')->nullable()->comment('Описание матча');
            $table->timestamps();
            
            $table->index(['match_date', 'status']);
            $table->index('prediction_deadline');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_match_predictions');
    }
};

