<?php

namespace App\Console\Commands;

use App\Models\FriendlyMatches\FriendlyMatch;
use App\Models\Tournaments\TournamentMatch;
use App\Models\UserTeams\UserTeam;
use App\Services\NotificationService;
use Illuminate\Console\Command;
use Carbon\Carbon;

class SendGameReminders extends Command
{
    protected $signature = 'notifications:send-game-reminders';
    protected $description = 'Send game reminder notifications (24h and 1h before match)';

    protected NotificationService $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        parent::__construct();
        $this->notificationService = $notificationService;
    }

    public function handle(): int
    {
        $this->info('Проверка напоминаний о матчах...');

        // Напоминания за 24 часа
        $this->send24hReminders();
        
        // Напоминания за 1 час
        $this->send1hReminders();

        $this->info('Проверка завершена.');

        return Command::SUCCESS;
    }

    protected function send24hReminders(): void
    {
        $targetTime = now()->addHours(24);
        $startTime = $targetTime->copy()->startOfHour();
        $endTime = $targetTime->copy()->endOfHour();

        // Товарищеские матчи
        $friendlyMatches = FriendlyMatch::where('status', 'scheduled')
            ->whereBetween('date', [$startTime, $endTime])
            ->with(['homeTeam', 'awayTeam'])
            ->get();

        foreach ($friendlyMatches as $match) {
            $this->sendReminderToTeamUsers($match, 'friendly', '24h');
        }

        // Турнирные матчи
        $tournamentMatches = TournamentMatch::where('status', 'scheduled')
            ->whereBetween('date', [$startTime, $endTime])
            ->with(['homeTeam', 'awayTeam'])
            ->get();

        foreach ($tournamentMatches as $match) {
            $this->sendReminderToTeamUsers($match, 'tournament', '24h');
        }
    }

    protected function send1hReminders(): void
    {
        $targetTime = now()->addHour();
        $startTime = $targetTime->copy()->startOfMinute();
        $endTime = $targetTime->copy()->endOfMinute();

        // Товарищеские матчи
        $friendlyMatches = FriendlyMatch::where('status', 'scheduled')
            ->whereBetween('date', [$startTime, $endTime])
            ->with(['homeTeam', 'awayTeam'])
            ->get();

        foreach ($friendlyMatches as $match) {
            $this->sendReminderToTeamUsers($match, 'friendly', '1h');
        }

        // Турнирные матчи
        $tournamentMatches = TournamentMatch::where('status', 'scheduled')
            ->whereBetween('date', [$startTime, $endTime])
            ->with(['homeTeam', 'awayTeam'])
            ->get();

        foreach ($tournamentMatches as $match) {
            $this->sendReminderToTeamUsers($match, 'tournament', '1h');
        }
    }

    protected function sendReminderToTeamUsers($match, string $matchType, string $reminderType): void
    {
        $currentSeason = now()->year;
        
        // Получаем пользователей команды 1
        $team1Users = UserTeam::where('team_id', $match->team_1)
            ->where('season', $currentSeason)
            ->with('user')
            ->get()
            ->pluck('user')
            ->filter();

        // Получаем пользователей команды 2
        $team2Users = UserTeam::where('team_id', $match->team_2)
            ->where('season', $currentSeason)
            ->with('user')
            ->get()
            ->pluck('user')
            ->filter();

        // Объединяем и убираем дубликаты
        $allUsers = $team1Users->merge($team2Users)->unique('id');

        $sentCount = 0;
        foreach ($allUsers as $user) {
            if ($reminderType === '24h') {
                $this->notificationService->notifyGameReminder24h($user, $match, $matchType);
            } else {
                $this->notificationService->notifyGameReminder1h($user, $match, $matchType);
            }
            $sentCount++;
        }

        $this->info("Отправлено {$reminderType} напоминаний для матча #{$match->id}: {$sentCount} пользователям");
    }
}

