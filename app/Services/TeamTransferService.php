<?php

namespace App\Services;

use App\Models\Teams\Team;
use App\Models\User;
use App\Models\UserTeams\UserTeam;
use App\Models\Tournaments\TournamentSeason;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TeamTransferService
{
    /**
     * Максимальное количество активных игроков в команде
     */
    const MAX_ACTIVE_PLAYERS = 100;

    /**
     * Минимальное количество игроков в команде
     */
    const MIN_ACTIVE_PLAYERS = 15;

    /**
     * Начало трансферного окна (1 июня)
     */
    const TRANSFER_WINDOW_START_MONTH = 6; // Июнь
    const TRANSFER_WINDOW_START_DAY = 1;

    /**
     * Конец трансферного окна (31 августа)
     */
    const TRANSFER_WINDOW_END_MONTH = 8; // Август
    const TRANSFER_WINDOW_END_DAY = 31;

    /**
     * Проверка, открыто ли трансферное окно
     */
    public function isTransferWindowOpen(): bool
    {
        $now = Carbon::now();
        $currentYear = $now->year;
        
        $startDate = Carbon::create($currentYear, self::TRANSFER_WINDOW_START_MONTH, self::TRANSFER_WINDOW_START_DAY)->startOfDay();
        $endDate = Carbon::create($currentYear, self::TRANSFER_WINDOW_END_MONTH, self::TRANSFER_WINDOW_END_DAY)->endOfDay();
        
        return $now->between($startDate, $endDate);
    }

    /**
     * Получить даты трансферного окна
     */
    public function getTransferWindowDates(): array
    {
        $currentYear = Carbon::now()->year;
        
        return [
            'start' => Carbon::create($currentYear, self::TRANSFER_WINDOW_START_MONTH, self::TRANSFER_WINDOW_START_DAY),
            'end' => Carbon::create($currentYear, self::TRANSFER_WINDOW_END_MONTH, self::TRANSFER_WINDOW_END_DAY),
        ];
    }

    /**
     * Проверка, может ли пользователь присоединиться к команде
     */
    public function canJoinTeam(User $user, Team $team): array
    {
        $result = [
            'can_join' => false,
            'reason' => '',
            'is_premium' => $user->hasActiveSubscription(),
        ];

        // Проверка 1: Есть ли у пользователя текущая команда в текущем сезоне
        $currentSeason = $this->getCurrentSeason();
        
        $currentUserTeam = UserTeam::where('user_id', $user->id)
            ->where('season', $currentSeason)
            ->first();

        // Если у пользователя нет команды - разрешаем присоединение (новый пользователь)
        if (!$currentUserTeam) {
            // Проверяем только лимит игроков
            $activePlayersCount = $this->getActivePlayersCount($team);
            if ($activePlayersCount >= self::MAX_ACTIVE_PLAYERS) {
                $result['reason'] = 'В команде достигнут лимит активных игроков (100 человек)';
                return $result;
            }
            
            $result['can_join'] = true;
            return $result;
        }

        // Если у пользователя уже есть команда в текущем сезоне
        if ($currentUserTeam) {
            // Если это та же команда
            if ($currentUserTeam->team_id == $team->id) {
                $result['reason'] = 'Вы уже состоите в этой команде';
                return $result;
            }

            // Если у пользователя нет премиум аккаунта
            if (!$result['is_premium']) {
                // Проверяем трансферное окно
                if (!$this->isTransferWindowOpen()) {
                    $result['reason'] = 'Трансферное окно закрыто. Вы можете сменить команду только с 1 июня по 31 августа.';
                    return $result;
                }

                // Проверяем, не менял ли уже команду в этом трансферном окне
                $transferWindowDates = $this->getTransferWindowDates();
                $transfersInWindow = UserTeam::where('user_id', $user->id)
                    ->where('season', $currentSeason)
                    ->whereBetween('created_at', [
                        $transferWindowDates['start'],
                        $transferWindowDates['end']
                    ])
                    ->count();

                if ($transfersInWindow > 0) {
                    $result['reason'] = 'Вы уже использовали возможность смены команды в этом трансферном окне. Премиум аккаунт позволяет менять команду неограниченное количество раз.';
                    return $result;
                }
            }
        }

        // Проверка 2: Лимит игроков в команде
        $activePlayersCount = $this->getActivePlayersCount($team);
        if ($activePlayersCount >= self::MAX_ACTIVE_PLAYERS) {
            $result['reason'] = 'В команде достигнут лимит активных игроков (100 человек)';
            return $result;
        }

        $result['can_join'] = true;
        return $result;
    }

    /**
     * Присоединить пользователя к команде
     */
    public function joinTeam(User $user, Team $team): array
    {
        $canJoin = $this->canJoinTeam($user, $team);
        
        if (!$canJoin['can_join']) {
            return [
                'success' => false,
                'message' => $canJoin['reason'],
            ];
        }

        $currentSeason = $this->getCurrentSeason();

        DB::beginTransaction();
        try {
            // Если у пользователя уже есть команда в текущем сезоне, удаляем старую запись
            UserTeam::where('user_id', $user->id)
                ->where('season', $currentSeason)
                ->delete();

            // Создаем новую запись
            $userTeam = new UserTeam();
            $userTeam->user_id = $user->id;
            $userTeam->team_id = $team->id;
            $userTeam->season = $currentSeason;
            $userTeam->save();

            DB::commit();

            return [
                'success' => true,
                'message' => 'Вы успешно присоединились к команде!',
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'success' => false,
                'message' => 'Ошибка при присоединении к команде: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * Получить количество активных игроков в команде
     */
    public function getActivePlayersCount(Team $team, ?int $season = null): int
    {
        if (!$season) {
            $season = $this->getCurrentSeason();
        }

        return UserTeam::where('team_id', $team->id)
            ->where('season', $season)
            ->count();
    }

    /**
     * Получить текущий сезон (год) для использования в запросах
     */
    public function getCurrentSeason(): int
    {
        return Carbon::now()->year;
    }

    /**
     * Проверка, может ли пользователь покинуть команду
     */
    public function canLeaveTeam(User $user, Team $team): array
    {
        $result = [
            'can_leave' => false,
            'reason' => '',
        ];

        $currentSeason = $this->getCurrentSeason();

        // Проверяем, состоит ли пользователь в этой команде
        $currentUserTeam = UserTeam::where('user_id', $user->id)
            ->where('team_id', $team->id)
            ->where('season', $currentSeason)
            ->first();

        if (!$currentUserTeam) {
            $result['reason'] = 'Вы не состоите в этой команде';
            return $result;
        }

        // Проверяем минимальный состав
        $activePlayersCount = $this->getActivePlayersCount($team);
        if ($activePlayersCount <= self::MIN_ACTIVE_PLAYERS) {
            $result['reason'] = 'У команды минимальный состав (' . self::MIN_ACTIVE_PLAYERS . ' игроков). Выход из команды невозможен.';
            return $result;
        }

        $result['can_leave'] = true;
        return $result;
    }

    /**
     * Покинуть команду
     */
    public function leaveTeam(User $user, Team $team): array
    {
        $canLeave = $this->canLeaveTeam($user, $team);
        
        if (!$canLeave['can_leave']) {
            return [
                'success' => false,
                'message' => $canLeave['reason'],
            ];
        }

        $currentSeason = $this->getCurrentSeason();

        DB::beginTransaction();
        try {
            UserTeam::where('user_id', $user->id)
                ->where('team_id', $team->id)
                ->where('season', $currentSeason)
                ->delete();

            DB::commit();

            return [
                'success' => true,
                'message' => 'Вы успешно покинули команду!',
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'success' => false,
                'message' => 'Ошибка при выходе из команды: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * Получить правила присоединения к команде
     */
    public function getTransferRules(): array
    {
        $transferWindowDates = $this->getTransferWindowDates();
        $isOpen = $this->isTransferWindowOpen();
        
        return [
            'max_players' => self::MAX_ACTIVE_PLAYERS,
            'min_players' => self::MIN_ACTIVE_PLAYERS,
            'transfer_window_start' => $transferWindowDates['start']->format('d.m.Y'),
            'transfer_window_end' => $transferWindowDates['end']->format('d.m.Y'),
            'transfer_window_open' => $isOpen,
            'transfers_per_window' => 1,
            'premium_benefits' => [
                'unlimited_transfers' => true,
                'transfer_outside_window' => true,
            ],
        ];
    }
}

