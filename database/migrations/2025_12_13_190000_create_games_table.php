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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('preview')->nullable(); // Путь к изображению превью
            $table->text('rules')->nullable(); // Правила игры
            $table->integer('rating_points')->default(0); // Баллы рейтинга за победу
            $table->boolean('status')->default(true); // Активна ли игра
            $table->integer('order')->default(0); // Порядок отображения
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};

