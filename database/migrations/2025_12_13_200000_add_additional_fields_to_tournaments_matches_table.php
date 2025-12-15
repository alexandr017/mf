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
            $table->foreignId('stadium_id')->nullable()->after('group_id')->constrained('teams')->nullOnDelete()->comment('ID команды-владельца стадиона');
            $table->string('referee')->nullable()->after('date');
            $table->integer('attendance')->nullable()->after('referee');
            $table->text('description')->nullable()->after('pen_2');
            $table->string('video_url')->nullable()->after('description');
            $table->text('match_report')->nullable()->after('video_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tournaments_matches', function (Blueprint $table) {
            $table->dropForeign(['stadium_id']);
            $table->dropColumn(['stadium_id', 'referee', 'attendance', 'description', 'video_url', 'match_report']);
        });
    }
};

