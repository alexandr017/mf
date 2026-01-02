<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Удаляем foreign key
        try {
            DB::statement('ALTER TABLE `user_teams` DROP FOREIGN KEY `user_teams_season_id_foreign`');
        } catch (\Exception $e) {
            // Игнорируем, если foreign key не существует
        }
        
        // Удаляем индексы - пробуем все возможные варианты имен
        $indexesToDrop = [
            'user_teams_user_id_season_id_unique',  // unique индекс
            'user_teams_user_id_season_id_index',    // обычный индекс
            'user_teams_team_id_season_id_index',    // индекс team_id + season_id
        ];
        
        foreach ($indexesToDrop as $indexName) {
            try {
                DB::statement("ALTER TABLE `user_teams` DROP INDEX `{$indexName}`");
            } catch (\Exception $e) {
                // Игнорируем, если индекс не существует
            }
        }

        // Сохраняем данные: получаем год из tournaments_seasons
        $userTeams = DB::table('user_teams')->get();
        $seasonYears = [];
        foreach ($userTeams as $userTeam) {
            if ($userTeam->season_id) {
                $season = DB::table('tournaments_seasons')->where('id', $userTeam->season_id)->first();
                if ($season) {
                    $seasonYears[$userTeam->id] = $season->year_start; // Используем год начала сезона
                } else {
                    // Если сезон не найден, используем текущий год
                    $seasonYears[$userTeam->id] = date('Y');
                }
            } else {
                // Если season_id null, используем текущий год
                $seasonYears[$userTeam->id] = date('Y');
            }
        }

        Schema::table('user_teams', function (Blueprint $table) {
            // Удаляем старую колонку
            $table->dropColumn('season_id');
            
            // Добавляем новую колонку season (год)
            $table->integer('season')->after('team_id')->default(date('Y'))->comment('Год сезона');
            
            // Обновляем уникальный индекс
            $table->unique(['user_id', 'season']);
            $table->index(['team_id', 'season']);
        });

        // Восстанавливаем данные
        foreach ($seasonYears as $userTeamId => $year) {
            DB::table('user_teams')->where('id', $userTeamId)->update(['season' => $year]);
        }

        // Для записей без сезона устанавливаем текущий год (на случай если что-то пропустили)
        $currentYear = date('Y');
        DB::table('user_teams')->whereNull('season')->orWhere('season', 0)->update(['season' => $currentYear]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_teams', function (Blueprint $table) {
            // Удаляем индексы
            $table->dropUnique(['user_id', 'season']);
            $table->dropIndex(['team_id', 'season']);
            
            // Удаляем колонку season
            $table->dropColumn('season');
            
            // Возвращаем season_id
            $table->foreignId('season_id')->after('team_id')->constrained('tournaments_seasons')->cascadeOnDelete();
            
            // Возвращаем индексы
            $table->unique(['user_id', 'season_id']);
            $table->index(['team_id', 'season_id']);
        });
    }
};

