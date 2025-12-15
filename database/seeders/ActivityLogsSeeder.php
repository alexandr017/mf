<?php

namespace Database\Seeders;

use App\Models\ActivityLogs\ActivityLog;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ActivityLogsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $actions = ['create', 'update', 'delete', 'login', 'logout', 'view', 'export', 'import'];
        $modelTypes = [
            'App\Models\Tournaments\Tournament',
            'App\Models\Tournaments\TournamentSeason',
            'App\Models\Tournaments\TournamentMatch',
            'App\Models\Tournaments\TournamentTemplate',
            'App\Models\Tournaments\TournamentStage',
            'App\Models\Tournaments\TournamentGroup',
            'App\Models\Teams\Team',
            'App\Models\TeamPlayers\TeamPlayer',
            'App\Models\User',
            'App\Models\News\News',
            'App\Models\Games\Game',
            'App\Models\GameCategories\GameCategory',
            'App\Models\Achievements\Achievement',
            'App\Models\Tickets\Ticket',
            'App\Models\Tickets\TicketMessage',
            'App\Models\Countries\Country',
            'App\Models\Cities\City',
            'App\Models\StaticPages\StaticPage',
            'App\Models\FAQ\FAQ',
            'App\Models\MatchEvents\MatchEvent',
            'App\Models\Transactions\Transaction',
            'App\Models\UserGameResults\UserGameResult',
            null, // Системные действия без модели
        ];

        $users = User::pluck('id')->toArray();
        $userAgents = [
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36',
            'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36',
        ];

        $descriptions = [
            'Создан новый турнир',
            'Обновлена информация о турнире',
            'Удален турнир',
            'Создан новый сезон',
            'Обновлен сезон',
            'Создан новый матч',
            'Обновлен счет матча',
            'Пользователь вошел в систему',
            'Пользователь вышел из системы',
            'Просмотр списка пользователей',
            'Экспорт данных',
            'Импорт данных',
            'Создана новая команда',
            'Обновлена информация о команде',
            'Создана новость',
            'Обновлена новость',
            'Удалена новость',
        ];

        $batchSize = 500;
        $totalRecords = 10000;
        $batches = ceil($totalRecords / $batchSize);

        for ($batch = 0; $batch < $batches; $batch++) {
            $records = [];
            $startDate = now()->subMonths(6);
            $endDate = now();

            for ($i = 0; $i < $batchSize && ($batch * $batchSize + $i) < $totalRecords; $i++) {
                $modelType = $modelTypes[array_rand($modelTypes)];
                $userId = !empty($users) && rand(0, 10) > 2 ? $users[array_rand($users)] : null; // 80% с пользователем
                $action = $actions[array_rand($actions)];
                $modelId = $modelType ? rand(1, 1000) : null;
                
                $createdAt = $this->randomDate($startDate, $endDate);

                $records[] = [
                    'user_id' => $userId,
                    'action' => $action,
                    'model_type' => $modelType,
                    'model_id' => $modelId,
                    'changes' => $modelType && in_array($action, ['create', 'update']) 
                        ? json_encode(['field' => 'value']) 
                        : null,
                    'ip_address' => $this->randomIp(),
                    'user_agent' => $userAgents[array_rand($userAgents)],
                    'description' => $descriptions[array_rand($descriptions)],
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ];
            }

            DB::table('activity_logs')->insert($records);
            
            $this->command->info("Создано " . (($batch + 1) * $batchSize) . " записей из {$totalRecords}");
        }

        $this->command->info("Создано {$totalRecords} записей логов действий");
    }

    private function randomDate($start, $end)
    {
        $startTimestamp = $start->timestamp;
        $endTimestamp = $end->timestamp;
        $randomTimestamp = mt_rand($startTimestamp, $endTimestamp);
        return date('Y-m-d H:i:s', $randomTimestamp);
    }

    private function randomIp()
    {
        return rand(1, 255) . '.' . rand(1, 255) . '.' . rand(1, 255) . '.' . rand(1, 255);
    }
}

