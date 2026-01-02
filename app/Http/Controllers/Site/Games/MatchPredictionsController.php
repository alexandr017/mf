<?php

namespace App\Http\Controllers\Site\Games;

use App\Models\Games\MatchPrediction;
use App\Models\Games\MatchPredictionUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MatchPredictionsController
{
    const RATING_REWARD = 0.001;

    public function index()
    {
        $user = Auth::user();
        
        // Получаем матчи на ближайшие 7 дней, которые еще можно прогнозировать
        $now = \Carbon\Carbon::now();
        $sevenDaysLater = $now->copy()->addDays(7);
        
        $matches = MatchPrediction::where('status', 'scheduled')
            ->where('match_date', '>=', $now)
            ->where('match_date', '<=', $sevenDaysLater)
            ->where('prediction_deadline', '>', $now)
            ->orderBy('match_date', 'asc')
            ->get();
        
        // Получаем прогнозы пользователя
        $userPredictions = [];
        if ($user) {
            $predictions = MatchPredictionUser::where('user_id', $user->id)
                ->whereIn('match_id', $matches->pluck('id'))
                ->get()
                ->keyBy('match_id');
            
            foreach ($predictions as $prediction) {
                $userPredictions[$prediction->match_id] = $prediction->prediction;
            }
        }
        
        // Статистика пользователя
        $totalPredictions = 0;
        $correctPredictions = 0;
        $totalRatingEarned = 0;
        
        if ($user) {
            $totalPredictions = MatchPredictionUser::where('user_id', $user->id)->count();
            $correctPredictions = MatchPredictionUser::where('user_id', $user->id)
                ->where('is_correct', true)
                ->count();
            $totalRatingEarned = MatchPredictionUser::where('user_id', $user->id)
                ->sum('rating_earned');
        }
        
        return view('site.v1.templates.games.match-predictions', compact(
            'matches',
            'userPredictions',
            'totalPredictions',
            'correctPredictions',
            'totalRatingEarned'
        ));
    }

    public function predict(Request $request, $matchId)
    {
        $validator = Validator::make($request->all(), [
            'prediction' => ['required', 'in:team_1,draw,team_2'],
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

        $match = MatchPrediction::findOrFail($matchId);

        // Проверяем, можно ли делать прогноз
        if (!$match->canPredict()) {
            return response()->json([
                'success' => false,
                'message' => 'Время для прогноза истекло'
            ], 400);
        }

        // Проверяем, не делал ли уже прогноз
        $existingPrediction = MatchPredictionUser::where('user_id', $user->id)
            ->where('match_id', $matchId)
            ->first();

        if ($existingPrediction) {
            return response()->json([
                'success' => false,
                'message' => 'Вы уже сделали прогноз на этот матч'
            ], 400);
        }

        DB::beginTransaction();
        try {
            $prediction = MatchPredictionUser::create([
                'user_id' => $user->id,
                'match_id' => $matchId,
                'prediction' => $request->input('prediction'),
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Прогноз сохранен!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при сохранении прогноза: ' . $e->getMessage()
            ], 500);
        }
    }
}

