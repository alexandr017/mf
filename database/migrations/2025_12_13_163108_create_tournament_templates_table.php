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
        Schema::create('tournament_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['league', 'cup', 'supercup', 'mixed']);
            $table->text('description')->nullable();
            $table->json('structure_json'); // Описание структуры (стадии, группы)
            $table->json('config_json'); // Настройки генерации (количество команд, раундов и т.д.)
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournament_templates');
    }
};
