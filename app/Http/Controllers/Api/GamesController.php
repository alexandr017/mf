<?php

namespace App\Http\Controllers\Api;

use App\Models\UserGameResults\UserGameResult;
use App\Models\Transactions\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GamesController
{
    public function saveResult(Request $request)
    {
        $user = Auth::user();
        
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        $validated = $request->validate([
            'game_id' => 'required|exists:games,id',
            'score' => 'required|integer|min:0',
            'rating_points_earned' => 'required|integer|min:0',
            'win' => 'required|boolean',
            'played_at' => 'nullable|date',
        ]);
        
        // Сохраняем результат игры
        $result = new UserGameResult([
            'user_id' => $user->id,
            'game_id' => $validated['game_id'],
            'score' => $validated['score'],
            'rating_points_earned' => $validated['rating_points_earned'],
            'win' => $validated['win'],
            'played_at' => $validated['played_at'] ?? now(),
        ]);
        $result->save();
        
        // Если победа, начисляем баллы рейтинга
        if ($validated['win'] && $validated['rating_points_earned'] > 0) {
            // Обновляем рейтинг пользователя
            $user->increment('rating', $validated['rating_points_earned']);
            
            // Создаем транзакцию
            Transaction::create([
                'user_id' => $user->id,
                'game_id' => $validated['game_id'],
                'points' => $validated['rating_points_earned'],
                'type' => 'earn',
                'description' => 'Победа в игре',
                'details' => json_encode([
                    'game_result_id' => $result->id,
                    'score' => $validated['score'],
                ]),
            ]);
        }
        
        return response()->json([
            'success' => true,
            'result' => $result,
            'new_rating' => $user->fresh()->rating,
        ]);
    }
}


