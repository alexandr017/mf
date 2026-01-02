<?php

namespace Database\Seeders;

use App\Models\FriendlyMatches\FriendlyMatch;
use App\Models\User;
use App\Models\UserTeams\UserTeam;
use App\Repositories\Site\Ratings\RatingsRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class FriendlyMatchesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ratingsRepository = new RatingsRepository();
        
        // Получаем топ 40 команд
        $topTeams = $ratingsRepository->getTopTeams(40);
        
        if ($topTeams->count() < 2) {
            $this->command->warn('Недостаточно команд для создания товарищеских матчей. Нужно минимум 2 команды.');
            return;
        }
        
        $teamIds = $topTeams->pluck('id')->toArray();
        $matchesCreated = 0;
        $matchesPlayed = 0;
        
        // Создаем матчи на 30 дней вперед (по 2 матча в день)
        $startDate = Carbon::now()->startOfDay();
        
        for ($day = 0; $day < 30; $day++) {
            $currentDate = $startDate->copy()->addDays($day);
            
            // Перемешиваем команды для случайного порядка
            shuffle($teamIds);
            
            // Создаем 2 матча в день
            for ($matchNum = 0; $matchNum < 2; $matchNum++) {
                // Берем пары команд по порядку
                $team1Index = ($matchNum * 2) % count($teamIds);
                $team2Index = ($matchNum * 2 + 1) % count($teamIds);
                
                // Если команды совпадают, берем следующую
                if ($team1Index === $team2Index) {
                    $team2Index = ($team2Index + 1) % count($teamIds);
                }
                
                $team1Id = $teamIds[$team1Index];
                $team2Id = $teamIds[$team2Index];
                
                // Время матча: первый в 18:00, второй в 20:00
                $matchTime = $currentDate->copy()->setTime(18 + ($matchNum * 2), 0);
                
                // Определяем статус: первые 10 матчей (5 дней) - завершенные
                $isPlayed = $matchesPlayed < 10;
                $status = $isPlayed ? 'played' : 'scheduled';
                
                $match = new FriendlyMatch([
                    'team_1' => $team1Id,
                    'team_2' => $team2Id,
                    'date' => $matchTime,
                    'status' => $status,
                ]);
                
                // Если матч завершен, генерируем данные
                if ($isPlayed) {
                    $this->generateMatchData($match, $team1Id, $team2Id);
                    $matchesPlayed++;
                }
                
                $match->save();
                $matchesCreated++;
            }
        }
        
        $this->command->info("Создано товарищеских матчей: {$matchesCreated}");
        $this->command->info("Завершенных матчей: {$matchesPlayed}");
        
        // Генерируем данные для завершенных матчей, у которых их нет
        $this->command->info("Генерация данных для завершенных матчей...");
        $playedMatches = FriendlyMatch::where('status', 'played')
            ->where(function($query) {
                $query->whereNull('scorers')
                      ->orWhereNull('assists');
                // Проверяем наличие колонки squad перед использованием
                if (Schema::hasColumn('friendly_matches', 'squad')) {
                    $query->orWhereNull('squad');
                }
            })
            ->get();
        
        foreach ($playedMatches as $match) {
            $this->generateMatchData($match, $match->team_1, $match->team_2);
            $match->save();
        }
        
        $this->command->info("Обработано матчей: {$playedMatches->count()}");
    }
    
    /**
     * Генерировать данные для матча (счет, голы, ассисты, заявки)
     */
    protected function generateMatchData(FriendlyMatch $match, int $team1Id, int $team2Id): void
    {
        // Генерируем случайный счет, если его нет
        if ($match->score_1 === null || $match->score_2 === null) {
            $score1 = rand(0, 5);
            $score2 = rand(0, 5);
            $match->score_1 = $score1;
            $match->score_2 = $score2;
        } else {
            $score1 = $match->score_1;
            $score2 = $match->score_2;
        }
        
        $totalGoals = $score1 + $score2;
        
        // Получаем топ игроков обеих команд
        $team1Players = $this->getTopPlayers($team1Id, 11);
        $team2Players = $this->getTopPlayers($team2Id, 11);
        
        if (empty($team1Players) || empty($team2Players)) {
            return;
        }
        
        // Формируем заявки (33 игрока на команду)
        $squad1 = [];
        $squad2 = [];
        
        $squad1Players = array_slice($team1Players, 0, min(33, count($team1Players)));
        $squad2Players = array_slice($team2Players, 0, min(33, count($team2Players)));
        
        while (count($squad1Players) < 33 && count($team1Players) > 0) {
            $squad1Players[] = $team1Players[array_rand($team1Players)];
        }
        while (count($squad2Players) < 33 && count($team2Players) > 0) {
            $squad2Players[] = $team2Players[array_rand($team2Players)];
        }
        
        // Формируем заявки с интервалами по 30 минут
        $intervals = [[0, 30], [30, 60], [60, 90]];
        $playersPerInterval = 11;
        
        foreach ($intervals as $interval) {
            $startMinute = $interval[0];
            $endMinute = $interval[1];
            
            $intervalPlayers1 = array_slice($squad1Players, 0, $playersPerInterval);
            $squad1Players = array_slice($squad1Players, $playersPerInterval);
            foreach ($intervalPlayers1 as $player) {
                $squad1[] = [
                    'user_id' => $player->id,
                    'start_minute' => $startMinute,
                    'end_minute' => $endMinute,
                ];
            }
            
            $intervalPlayers2 = array_slice($squad2Players, 0, $playersPerInterval);
            $squad2Players = array_slice($squad2Players, $playersPerInterval);
            foreach ($intervalPlayers2 as $player) {
                $squad2[] = [
                    'user_id' => $player->id,
                    'start_minute' => $startMinute,
                    'end_minute' => $endMinute,
                ];
            }
        }
        
        // Генерируем голы с минутами
        $goalMinutes = [];
        for ($i = 0; $i < $totalGoals; $i++) {
            $goalMinutes[] = rand(1, 90);
        }
        sort($goalMinutes);
        
        $scorers = [];
        $assists = [];
        
        for ($i = 0; $i < $totalGoals; $i++) {
            $minute = $goalMinutes[$i];
            
            if ($i < $score1) {
                $availablePlayers = array_filter($squad1, function($s) use ($minute) {
                    return $s['start_minute'] <= $minute && $s['end_minute'] >= $minute;
                });
                if (empty($availablePlayers)) {
                    $availablePlayers = $squad1;
                }
                $player = $availablePlayers[array_rand($availablePlayers)];
                
                if (!isset($scorers[$player['user_id']])) {
                    $scorers[$player['user_id']] = [];
                }
                $scorers[$player['user_id']][] = ['minute' => $minute];
                
                $assistant = $availablePlayers[array_rand($availablePlayers)];
                if (!isset($assists[$assistant['user_id']])) {
                    $assists[$assistant['user_id']] = [];
                }
                $assists[$assistant['user_id']][] = ['minute' => $minute];
            } else {
                $availablePlayers = array_filter($squad2, function($s) use ($minute) {
                    return $s['start_minute'] <= $minute && $s['end_minute'] >= $minute;
                });
                if (empty($availablePlayers)) {
                    $availablePlayers = $squad2;
                }
                $player = $availablePlayers[array_rand($availablePlayers)];
                
                if (!isset($scorers[$player['user_id']])) {
                    $scorers[$player['user_id']] = [];
                }
                $scorers[$player['user_id']][] = ['minute' => $minute];
                
                $assistant = $availablePlayers[array_rand($availablePlayers)];
                if (!isset($assists[$assistant['user_id']])) {
                    $assists[$assistant['user_id']] = [];
                }
                $assists[$assistant['user_id']][] = ['minute' => $minute];
            }
        }
        
        // Преобразуем в JSON формат
        $scorersJson = [];
        foreach ($scorers as $userId => $goals) {
            $scorersJson[] = ['user_id' => $userId, 'goals' => $goals];
        }
        
        $assistsJson = [];
        foreach ($assists as $userId => $assistsList) {
            $assistsJson[] = ['user_id' => $userId, 'assists' => $assistsList];
        }
        
        $match->scorers = $scorersJson;
        $match->assists = $assistsJson;
        $match->squad = [
            'team_1' => $squad1,
            'team_2' => $squad2,
        ];
    }
    
    /**
     * Получить топ игроков команды по рейтингу
     */
    protected function getTopPlayers(int $teamId, int $limit = 11): array
    {
        $userTeamIds = UserTeam::where('team_id', $teamId)
            ->pluck('user_id')
            ->toArray();
        
        if (empty($userTeamIds)) {
            return [];
        }
        
        $players = User::whereIn('id', $userTeamIds)
            ->orderBy('rating', 'desc')
            ->orderBy('goals', 'desc')
            ->limit($limit)
            ->get()
            ->all();
        
        if (count($players) < $limit && count($players) > 0) {
            $playersArray = $players;
            while (count($players) < $limit) {
                $players[] = $playersArray[array_rand($playersArray)];
            }
        }
        
        return $players;
    }
}

