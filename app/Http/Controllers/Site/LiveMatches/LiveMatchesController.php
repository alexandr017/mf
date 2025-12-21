<?php

namespace App\Http\Controllers\Site\LiveMatches;

use App\Http\Controllers\Controller;
use App\Models\LiveMatches\LiveMatch;
use App\Models\Tournaments\TournamentMatch;
use App\Services\LiveMatches\MatchResultGenerator;
use App\Services\LiveMatches\MatchStateService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class LiveMatchesController extends Controller
{
    protected MatchStateService $matchStateService;
    protected MatchResultGenerator $resultGenerator;

    public function __construct(MatchStateService $matchStateService, MatchResultGenerator $resultGenerator)
    {
        $this->matchStateService = $matchStateService;
        $this->resultGenerator = $resultGenerator;
    }

    /**
     * Страница просмотра матча
     */
    public function show(int $matchId): View
    {
        $match = TournamentMatch::with(['homeTeam', 'awayTeam', 'stage', 'stadium'])
            ->findOrFail($matchId);

        // Проверяем, есть ли активный live match
        $liveMatch = LiveMatch::where('match_id', $matchId)
            ->where('status', '!=', 'finished')
            ->first();

        // Если нет активного матча, создаем новый (для тестирования)
        if (!$liveMatch) {
            $liveMatch = $this->resultGenerator->generateResult($match);
        }

        return view('site.v1.templates.live-matches.show', compact('match', 'liveMatch'));
    }

    /**
     * API endpoint для получения состояния матча (SSE или polling)
     * Оптимизирован для высокой нагрузки с кешированием
     */
    public function getState(int $matchId): JsonResponse
    {
        // Кешируем состояние на 0.5 секунды для более частого обновления времени
        // Но все равно снижаем нагрузку на БД
        $cacheKey = "live_match_state:{$matchId}";
        
        $state = Cache::remember($cacheKey, 0.5, function() use ($matchId) {
            return $this->matchStateService->getMatchState($matchId);
        });

        if (!$state) {
            return response()->json(['error' => 'Match not found'], 404);
        }

        // Добавляем заголовки для предотвращения кеширования на клиенте
        return response()->json($state)
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0')
            ->header('X-Accel-Buffering', 'no'); // Отключаем буферизацию для nginx
    }

    /**
     * Запустить матч (для админа)
     */
    public function start(int $matchId): JsonResponse
    {
        $match = TournamentMatch::findOrFail($matchId);

        // Проверяем, не запущен ли уже матч
        $existingLiveMatch = LiveMatch::where('match_id', $matchId)
            ->where('status', '!=', 'finished')
            ->first();

        if ($existingLiveMatch) {
            return response()->json(['error' => 'Match already started'], 400);
        }

        $liveMatch = $this->resultGenerator->generateResult($match);

        return response()->json([
            'success' => true,
            'live_match_id' => $liveMatch->id,
            'started_at' => $liveMatch->started_at->toIso8601String(),
        ]);
    }
}
