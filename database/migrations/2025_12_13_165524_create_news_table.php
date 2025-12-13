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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('alias')->unique();
            $table->string('h1')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('preview')->nullable(); // Изображение превью
            $table->text('short_content')->nullable(); // Краткое описание
            $table->text('content')->nullable(); // Полный текст
            $table->boolean('status')->default(1);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
