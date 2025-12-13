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
        Schema::create('tournaments_matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stage_id')->constrained('tournaments_stages')->cascadeOnDelete();
            $table->foreignId('group_id')->nullable()->constrained('tournaments_groups')->nullOnDelete();
            $table->foreignId('team_1')->constrained('teams');
            $table->foreignId('team_2')->constrained('teams');
            $table->dateTime('date')->nullable();
            $table->tinyInteger('score_1')->nullable();
            $table->tinyInteger('score_2')->nullable();
            $table->tinyInteger('pen_1')->nullable();
            $table->tinyInteger('pen_2')->nullable();
            $table->enum('status',['scheduled','played','cancelled'])->default('scheduled');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournaments_matches');
    }
};
