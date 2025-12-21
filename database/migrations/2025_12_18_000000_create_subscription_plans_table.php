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
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Базовый, Продвинутый
            $table->string('slug')->unique(); // basic, advanced
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2); // Цена в долларах
            $table->string('currency', 3)->default('USD');
            $table->decimal('rating_multiplier', 3, 2)->default(1.0); // Множитель прокачки рейтинга (1.5, 2.0)
            $table->integer('duration_days')->default(30); // Длительность подписки в днях
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_plans');
    }
};

