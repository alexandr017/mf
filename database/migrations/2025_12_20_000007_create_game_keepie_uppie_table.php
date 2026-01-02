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
        Schema::create('game_keepie_uppie', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->integer('score')->comment('Количество набитых мячей');
            $table->integer('duration_seconds')->comment('Длительность игры в секундах');
            $table->decimal('rating_earned', 8, 3)->default(0)->comment('Начисленные баллы рейтинга');
            $table->string('ip_address', 45)->nullable()->comment('IP адрес для защиты от накрутки');
            $table->string('user_agent')->nullable()->comment('User Agent для защиты от накрутки');
            $table->timestamps();
            
            $table->index(['user_id', 'created_at']);
            $table->index('score');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_keepie_uppie');
    }
};

