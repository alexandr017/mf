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
        Schema::table('friendly_matches', function (Blueprint $table) {
            // Добавляем поле для заявок и замен, если его еще нет
            // squad: {"team_1": [{"user_id": 1, "start_minute": 0, "end_minute": 30}, ...], "team_2": [...]}
            // Всего 33 игрока в заявке, каждые 30 минут меняются все
            if (!Schema::hasColumn('friendly_matches', 'squad')) {
                $table->json('squad')->nullable()->after('assists')->comment('JSON с заявками: {"team_1": [{"user_id": 1, "start_minute": 0, "end_minute": 30}, ...], "team_2": [...]}');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('friendly_matches', function (Blueprint $table) {
            if (Schema::hasColumn('friendly_matches', 'squad')) {
                $table->dropColumn('squad');
            }
        });
    }
};

