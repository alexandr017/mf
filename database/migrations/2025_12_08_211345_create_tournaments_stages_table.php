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
        Schema::create('tournaments_stages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tournaments_season_id')->constrained('tournaments_seasons')->cascadeOnDelete();
            $table->string('name');
            $table->enum('type',['league_round','cup_round','group_stage','playoff','final']);
            $table->integer('stage_order')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournaments_stages');
    }
};
