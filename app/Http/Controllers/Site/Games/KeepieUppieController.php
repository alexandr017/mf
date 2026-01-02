<?php

namespace App\Http\Controllers\Site\Games;

use App\Models\Games\KeepieUppie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class KeepieUppieController
{
    const MIN_DURATION_SECONDS = 3;
    const RATING_PER_SCORE = 0.0001; // 0.0001 балла за каждый набитый мяч

    public function index()
    {
        $user = Auth::user();
        
        // Статистика пользователя
        $userBestScore = 0;
        $totalGames = 0;
        $totalScore = 0;
        $totalRatingEarned = 0;
        
        if ($user) {
            $userBestScore = KeepieUppie::where('user_id', $user->id)->max('score') ?? 0;
            $totalGames = KeepieUppie::where('user_id', $user->id)->count();
            $totalScore = KeepieUppie::where('user_id', $user->id)->sum('score');
            $totalRatingEarned = KeepieUppie::where('user_id', $user->id)->sum('rating_earned');
        }
        
        // Таблица лидеров (топ 10)
        $leaderboard = KeepieUppie::select('user_id', DB::raw('MAX(score) as best_score'))
            ->with('user:id,name,nickname,avatar')
            ->groupBy('user_id')
            ->orderBy('best_score', 'desc')
            ->limit(10)
            ->get();
        
        // Последние игры пользователя
        $recentGames = [];
        if ($user) {
            $recentGames = KeepieUppie::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();
        }
        
        return view('site.v1.templates.games.keepie-uppie', compact(
            'userBestScore',
            'totalGames',
            'totalScore',
            'totalRatingEarned',
            'leaderboard',
            'recentGames'
        ));
    }

    public function play(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'score' => ['required', 'integer', 'min:0'],
            'duration' => ['required', 'integer', 'min:0'],
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

        $score = $request->input('score');
        $duration = $request->input('duration');
        $startTime = $request->input('start_time');
        $currentTime = time();
        $actualDuration = $currentTime - $startTime;

        // Проверка времени выполнения (защита от накрутки)
        // Проверяем только подозрительно быстрые игры с высоким счетом
        if ($score > 20 && $actualDuration < 2) {
            return response()->json([
                'success' => false,
                'message' => 'Подозрительно быстрая игра'
            ], 400);
        }

        // Проверка на слишком частые запросы
        $lastGame = KeepieUppie::where('user_id', $user->id)
            ->where('created_at', '>=', now()->subSeconds(5))
            ->first();
        
        if ($lastGame) {
            return response()->json([
                'success' => false,
                'message' => 'Слишком частые попытки. Подождите немного.'
            ], 429);
        }

        // Начисляем рейтинг (0.0001 за каждый набитый мяч)
        $ratingEarned = $score * self::RATING_PER_SCORE;

        DB::beginTransaction();
        try {
            // Сохраняем результат игры
            $gameResult = KeepieUppie::create([
                'user_id' => $user->id,
                'score' => $score,
                'duration_seconds' => max($duration, $actualDuration), // Используем большее значение
                'rating_earned' => $ratingEarned,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            // Обновляем рейтинг пользователя
            if ($ratingEarned > 0) {
                $user->increment('rating', $ratingEarned);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'score' => $score,
                'rating_earned' => $ratingEarned,
                'new_rating' => $user->fresh()->rating,
                'message' => 'Отличная игра! Набито мячей: ' . $score . ' (+' . number_format($ratingEarned, 4) . ' к рейтингу)'
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

