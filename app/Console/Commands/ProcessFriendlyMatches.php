<?php

namespace App\Console\Commands;

use App\Models\FriendlyMatches\FriendlyMatch;
use App\Models\User;
use App\Models\UserTeams\UserTeam;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ProcessFriendlyMatches extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'friendly-matches:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process scheduled friendly matches - generate results and update player statistics';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $today = now()->startOfDay();
        $tomorrow = now()->endOfDay();

        // Находим все запланированные матчи на сегодня
        $matches = FriendlyMatch::with(['homeTeam', 'awayTeam'])
            ->where('status', 'scheduled')
            ->whereBetween('date', [$today, $tomorrow])
            ->get();

        if ($matches->isEmpty()) {
            $this->info('Нет запланированных товарищеских матчей на сегодня.');
            return Command::SUCCESS;
        }

        $this->info("Найдено матчей для обработки: {$matches->count()}");

        foreach ($matches as $match) {
            $this->processMatch($match);
        }

        return Command::SUCCESS;
    }

    /**
     * Обработать один матч
     */
    protected function processMatch(FriendlyMatch $match): void
    {
        $this->info("Обработка матча: {$match->homeTeam->name} vs {$match->awayTeam->name}");

        // Генерируем случайный счет
        $score1 = rand(0, 5);
        $score2 = rand(0, 5);
        $totalGoals = $score1 + $score2;

        // Получаем топ игроков обеих команд (топ 11 для каждой команды)
        $team1Players = $this->getTopPlayers($match->team_1, 11);
        $team2Players = $this->getTopPlayers($match->team_2, 11);

        // Если у команд нет игроков, пропускаем матч
        if (empty($team1Players) || empty($team2Players)) {
            $this->warn("Пропуск матча: у одной из команд нет игроков");
            return;
        }

        $scorers = [];
        $assists = [];

        // Формируем заявки (33 игрока на команду, каждые 30 минут меняются все)
        $squad1 = [];
        $squad2 = [];
        
        // Берем 33 игрока из каждой команды (если есть)
        $squad1Players = array_slice($team1Players, 0, min(33, count($team1Players)));
        $squad2Players = array_slice($team2Players, 0, min(33, count($team2Players)));
        
        // Если игроков меньше 33, дублируем
        while (count($squad1Players) < 33 && count($team1Players) > 0) {
            $squad1Players[] = $team1Players[array_rand($team1Players)];
        }
        while (count($squad2Players) < 33 && count($team2Players) > 0) {
            $squad2Players[] = $team2Players[array_rand($team2Players)];
        }
        
        // Формируем заявки с интервалами по 30 минут (0-30, 30-60, 60-90)
        $intervals = [[0, 30], [30, 60], [60, 90]];
        $playersPerInterval = 11; // 11 игроков на интервал
        
        foreach ($intervals as $interval) {
            $startMinute = $interval[0];
            $endMinute = $interval[1];
            
            // Команда 1
            $intervalPlayers1 = array_slice($squad1Players, 0, $playersPerInterval);
            $squad1Players = array_slice($squad1Players, $playersPerInterval);
            foreach ($intervalPlayers1 as $player) {
                $squad1[] = [
                    'user_id' => $player->id,
                    'start_minute' => $startMinute,
                    'end_minute' => $endMinute,
                ];
            }
            
            // Команда 2
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
        
        // Распределяем голы между игроками с минутами
        $goalMinutes = [];
        for ($i = 0; $i < $totalGoals; $i++) {
            $minute = rand(1, 90);
            $goalMinutes[] = $minute;
        }
        sort($goalMinutes);
        
        $goalIndex = 0;
        for ($i = 0; $i < $totalGoals; $i++) {
            $minute = $goalMinutes[$i];
            
            if ($i < $score1) {
                // Гол команды 1 - выбираем игрока, который играл в эту минуту
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

                // Случайный ассистент из той же команды
                $assistant = $availablePlayers[array_rand($availablePlayers)];
                if (!isset($assists[$assistant['user_id']])) {
                    $assists[$assistant['user_id']] = [];
                }
                $assists[$assistant['user_id']][] = ['minute' => $minute];
            } else {
                // Гол команды 2
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

                // Случайный ассистент из той же команды
                $assistant = $availablePlayers[array_rand($availablePlayers)];
                if (!isset($assists[$assistant['user_id']])) {
                    $assists[$assistant['user_id']] = [];
                }
                $assists[$assistant['user_id']][] = ['minute' => $minute];
            }
        }

        // Преобразуем массивы в формат JSON
        $scorersJson = [];
        foreach ($scorers as $userId => $goals) {
            $scorersJson[] = ['user_id' => $userId, 'goals' => $goals];
        }

        $assistsJson = [];
        foreach ($assists as $userId => $assistsList) {
            $assistsJson[] = ['user_id' => $userId, 'assists' => $assistsList];
        }
        
        $squadJson = [
            'team_1' => $squad1,
            'team_2' => $squad2,
        ];

        // Обновляем матч
        DB::transaction(function () use ($match, $score1, $score2, $scorersJson, $assistsJson, $squadJson, $scorers, $assists) {
            $match->update([
                'status' => 'played',
                'score_1' => $score1,
                'score_2' => $score2,
                'scorers' => $scorersJson,
                'assists' => $assistsJson,
                'squad' => $squadJson,
            ]);

            // Обновляем статистику игроков
            foreach ($scorers as $userId => $goals) {
                $goalsCount = is_array($goals) ? count($goals) : $goals;
                User::where('id', $userId)->increment('goals', $goalsCount);
            }

            foreach ($assists as $userId => $assistsList) {
                $assistsCount = is_array($assistsList) ? count($assistsList) : $assistsList;
                User::where('id', $userId)->increment('assists', $assistsCount);
            }
        });

        $this->info("Матч завершен: {$score1} - {$score2}");
    }

    /**
     * Получить топ игроков команды по рейтингу
     */
    protected function getTopPlayers(int $teamId, int $limit = 11): array
    {
        // Получаем игроков команды из текущего сезона (или без сезона, если нет активного)
        $userTeamIds = UserTeam::where('team_id', $teamId)
            ->pluck('user_id')
            ->toArray();

        if (empty($userTeamIds)) {
            // Если нет игроков в команде, возвращаем пустой массив
            return [];
        }

        // Получаем топ игроков по рейтингу
        $players = User::whereIn('id', $userTeamIds)
            ->orderBy('rating', 'desc')
            ->orderBy('goals', 'desc')
            ->limit($limit)
            ->get()
            ->all();

        // Если игроков меньше лимита, дублируем их для разнообразия
        if (count($players) < $limit && count($players) > 0) {
            $playersArray = $players;
            while (count($players) < $limit) {
                $players[] = $playersArray[array_rand($playersArray)];
            }
        }

        return $players;
    }
}

