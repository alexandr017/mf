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
        Schema::table('tournaments_matches', function (Blueprint $table) {
            $table->dropForeign(['team_1']);
            $table->dropForeign(['team_2']);
            $table->foreignId('team_1')->nullable()->change();
            $table->foreignId('team_2')->nullable()->change();
            $table->foreign('team_1')->references('id')->on('teams')->nullOnDelete();
            $table->foreign('team_2')->references('id')->on('teams')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tournaments_matches', function (Blueprint $table) {
            $table->dropForeign(['team_1']);
            $table->dropForeign(['team_2']);
            $table->foreignId('team_1')->nullable(false)->change();
            $table->foreignId('team_2')->nullable(false)->change();
            $table->foreign('team_1')->references('id')->on('teams');
            $table->foreign('team_2')->references('id')->on('teams');
        });
    }
};
