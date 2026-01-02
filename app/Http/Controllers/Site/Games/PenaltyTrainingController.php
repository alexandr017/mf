<?php

namespace App\Http\Controllers\Site\Games;

use App\Models\Games\PenaltyTraining;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PenaltyTrainingController
{
    const RATING_REWARD = 0.001;
    const MIN_DURATION_SECONDS = 5;

    public function index()
    {
        $user = Auth::user();
        
        // Получаем статистику пользователя
        $totalAttempts = PenaltyTraining::where('user_id', $user->id)->count();
        $successfulAttempts = PenaltyTraining::where('user_id', $user->id)->where('is_goal', true)->count();
        $totalRatingEarned = PenaltyTraining::where('user_id', $user->id)->sum('rating_earned');
        
        // Последние 10 попыток
        $recentAttempts = PenaltyTraining::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
        return view('site.v1.templates.games.penalty-training', compact(
            'totalAttempts',
            'successfulAttempts',
            'totalRatingEarned',
            'recentAttempts'
        ));
    }

    public function play(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'player_choice' => ['required', 'in:left,center,right'],
            'start_time' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Неверные данные',
                'errors' => $validator->errors()
            ], 400);
        }

        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Необходимо войти в систему'
            ], 401);
        }

        // Проверка времени выполнения (для защиты от накрутки)
        $startTime = $request->input('start_time');
        $currentTime = time();
        $duration = $currentTime - $startTime;

        // Если игра длилась меньше минимального времени, не начисляем рейтинг (защита от накрутки)
        $isValidDuration = $duration >= self::MIN_DURATION_SECONDS;

        // Проверка на слишком частые запросы (не более 1 игры в 5 секунд)
        $lastAttempt = PenaltyTraining::where('user_id', $user->id)
            ->where('created_at', '>=', now()->subSeconds(5))
            ->first();
        
        if ($lastAttempt) {
            return response()->json([
                'success' => false,
                'message' => 'Слишком частые попытки. Подождите немного.'
            ], 429);
        }

        // Генерируем случайный выбор вратаря
        $goalkeeperChoices = ['left', 'center', 'right'];
        $goalkeeperChoice = $goalkeeperChoices[array_rand($goalkeeperChoices)];
        
        $playerChoice = $request->input('player_choice');
        $isGoal = $playerChoice !== $goalkeeperChoice;
        
        // Начисляем рейтинг только если забил И игра длилась минимум 5 секунд (защита от накрутки)
        $ratingEarned = ($isGoal && $isValidDuration) ? self::RATING_REWARD : 0;

        DB::beginTransaction();
        try {
            // Сохраняем результат игры
            $gameResult = PenaltyTraining::create([
                'user_id' => $user->id,
                'player_choice' => $playerChoice,
                'goalkeeper_choice' => $goalkeeperChoice,
                'is_goal' => $isGoal,
                'rating_earned' => $ratingEarned,
                'duration_seconds' => $duration,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            // Обновляем рейтинг пользователя (только если игра длилась минимум 5 секунд)
            if ($ratingEarned > 0) {
                $user->increment('rating', $ratingEarned);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'is_goal' => $isGoal,
                'goalkeeper_choice' => $goalkeeperChoice,
                'rating_earned' => $ratingEarned,
                'new_rating' => $user->fresh()->rating,
                'message' => $isGoal ? 'Гол! +' . number_format($ratingEarned, 3) . ' к рейтингу' : 'Вратарь отбил!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при сохранении результата: ' . $e->getMessage()
            ], 500);
        }
    }
}

