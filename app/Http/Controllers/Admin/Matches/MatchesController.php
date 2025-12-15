<?php

namespace App\Http\Controllers\Admin\Matches;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\Matches\MatchRequest;
use App\Models\Teams\Team;
use App\Models\Tournaments\Tournament;
use App\Models\Tournaments\TournamentGroup;
use App\Http\Requests\Admin\MatchEvents\MatchEventRequest;
use App\Models\MatchEvents\MatchEvent;
use App\Models\Tournaments\TournamentMatch;
use App\Models\Tournaments\TournamentSeason;
use App\Models\Tournaments\TournamentStage;
use App\Repositories\Admin\Matches\MatchRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class MatchesController extends AdminController
{
    protected MatchRepository $matchRepository;

    public function __construct()
    {
        parent::__construct();
        $this->matchRepository = app(MatchRepository::class);
    }

    public function index(Request $request): View
    {
        $seasonId = $request->get('season_id');
        $stageId = $request->get('stage_id');
        
        $matches = $this->matchRepository->getForShow($seasonId, $stageId);
        $tournaments = Tournament::orderBy('name')->get();
        $seasons = $seasonId ? TournamentSeason::where('tournament_id', $request->get('tournament_id'))->orderBy('year_start', 'desc')->get() : collect();
        $stages = $seasonId ? TournamentStage::where('tournaments_season_id', $seasonId)->orderBy('stage_order')->get() : collect();

        $breadcrumbs = [['h1' => 'Матчи']];

        return view('admin.matches.index', compact('matches', 'tournaments', 'seasons', 'stages', 'seasonId', 'stageId', 'breadcrumbs'));
    }

    public function create(Request $request): View
    {
        $tournaments = Tournament::orderBy('name')->get();
        $seasons = TournamentSeason::orderBy('year_start', 'desc')->get();
        $stages = TournamentStage::orderBy('stage_order')->get();
        $groups = TournamentGroup::orderBy('name')->get();
        $teams = Team::where('status', 1)->orderBy('name')->get();
        
        $seasonId = $request->get('season_id');
        $stageId = $request->get('stage_id');

        $breadcrumbs = [
            ['h1' => 'Матчи', 'link' => route('admin.matches.index')],
            ['h1' => 'Создание'],
        ];

        $tournamentId = null;
        return view('admin.matches.create', compact('tournaments', 'seasons', 'stages', 'groups', 'teams', 'seasonId', 'stageId', 'tournamentId', 'breadcrumbs'));
    }

    public function store(MatchRequest $request): RedirectResponse
    {
        $data = $request->all();

        $data = empty_str_to_null($data);

        $item = new TournamentMatch($data);

        $result = $item->save();

        if ($result) {
            return redirect()
                ->route('admin.matches.index', ['season_id' => $data['stage_id'] ? TournamentStage::find($data['stage_id'])->tournaments_season_id : null])
                ->with('flash_success', 'Матч создан!');
        }

        return redirect()
            ->route('admin.matches.index')
            ->with('flash_errors', 'Ошибка создания!');
    }

    public function edit(string $id): View
    {
        $item = $this->matchRepository->findOrFail($id);
        
        $tournaments = Tournament::orderBy('name')->get();
        
        // Загружаем сезоны для выбранного турнира (если есть)
        $seasonId = $item->stage->tournaments_season_id ?? null;
        $tournamentId = $item->stage->season->tournament_id ?? null;
        
        $seasons = $tournamentId 
            ? TournamentSeason::where('tournament_id', $tournamentId)->orderBy('year_start', 'desc')->get()
            : TournamentSeason::orderBy('year_start', 'desc')->get();
        
        $stages = $seasonId 
            ? TournamentStage::where('tournaments_season_id', $seasonId)->orderBy('stage_order')->get()
            : TournamentStage::orderBy('stage_order')->get();
        
        $groups = $item->stage_id 
            ? TournamentGroup::where('stage_id', $item->stage_id)->orderBy('name')->get() 
            : collect();
        
        $teams = Team::where('status', 1)->orderBy('name')->get();

        $breadcrumbs = [
            ['h1' => 'Матчи', 'link' => route('admin.matches.index')],
            ['h1' => 'Редактирование'],
        ];

        return view('admin.matches.edit', compact('item', 'tournaments', 'seasons', 'stages', 'groups', 'teams', 'breadcrumbs', 'tournamentId', 'seasonId'));
    }

    public function update(MatchRequest $request, string $id): RedirectResponse
    {
        $item = $this->matchRepository->findOrFail($id);

        $data = $request->all();

        $data = empty_str_to_null($data);

        $result = $item->update($data);

        if ($result) {
            return redirect()
                ->route('admin.matches.index', ['season_id' => $item->stage->tournaments_season_id ?? null])
                ->with('flash_success', 'Матч обновлен!');
        }

        return redirect()
            ->route('admin.matches.index')
            ->with('flash_errors', 'Ошибка обновления!');
    }

    public function show(string $id): View
    {
        $match = $this->matchRepository->findOrFail($id);
        $events = $match->events()->with('user')->orderBy('minute')->get();
        $users = \App\Models\User::orderBy('name')->limit(1000)->get(['id', 'name']);
        
        $breadcrumbs = [
            ['h1' => 'Матчи', 'link' => route('admin.matches.index')],
            ['h1' => 'Просмотр матча'],
        ];

        return view('admin.matches.show', compact('match', 'events', 'users', 'breadcrumbs'));
    }

    public function destroy(string $id): RedirectResponse
    {
        $item = $this->matchRepository->findOrFail($id);
        $seasonId = $item->stage->tournaments_season_id ?? null;

        $result = $item->delete();

        if ($result) {
            return redirect()
                ->route('admin.matches.index', ['season_id' => $seasonId])
                ->with('flash_success', 'Матч удален!');
        }

        return redirect()
            ->route('admin.matches.index')
            ->with('flash_errors', 'Ошибка удаления!');
    }

    public function addEvent(MatchEventRequest $request, string $id): RedirectResponse
    {
        $match = $this->matchRepository->findOrFail($id);
        $data = $request->all();
        $data['match_id'] = $id;

        $event = new MatchEvent($data);
        $result = $event->save();

        if ($result) {
            // Обновляем счет матча на основе событий
            $this->updateMatchScore($match);

            return redirect()
                ->route('admin.matches.show', $match->id)
                ->with('flash_success', 'Событие добавлено!');
        }

        return redirect()
            ->route('admin.matches.show', $match->id)
            ->with('flash_errors', 'Ошибка добавления события!');
    }

    public function deleteEvent(string $matchId, string $eventId): RedirectResponse
    {
        $match = $this->matchRepository->findOrFail($matchId);
        $event = MatchEvent::findOrFail($eventId);

        if ($event->match_id != $matchId) {
            return redirect()
                ->route('admin.matches.show', $matchId)
                ->with('flash_errors', 'Событие не принадлежит этому матчу!');
        }

        $result = $event->delete();

        if ($result) {
            // Обновляем счет матча на основе событий
            $this->updateMatchScore($match);

            return redirect()
                ->route('admin.matches.show', $matchId)
                ->with('flash_success', 'Событие удалено!');
        }

        return redirect()
            ->route('admin.matches.show', $matchId)
            ->with('flash_errors', 'Ошибка удаления события!');
    }

    private function updateMatchScore(TournamentMatch $match): void
    {
        if (!$match->team_1 || !$match->team_2) {
            return; // Нельзя обновить счет, если команды не определены
        }

        // Получаем сезон матча
        $seasonId = $match->stage->tournaments_season_id ?? null;
        if (!$seasonId) {
            return;
        }

        // Подсчитываем голы для каждой команды
        // Голы команды 1 - игроки, которые состоят в команде 1 в этом сезоне
        $team1Goals = $match->goals()->whereHas('user', function($q) use ($match, $seasonId) {
            $q->whereHas('teams', function($q2) use ($match, $seasonId) {
                $q2->where('teams.id', $match->team_1)
                   ->where('team_players.season_id', $seasonId);
            });
        })->count();

        // Голы команды 2 - игроки, которые состоят в команде 2 в этом сезоне
        $team2Goals = $match->goals()->whereHas('user', function($q) use ($match, $seasonId) {
            $q->whereHas('teams', function($q2) use ($match, $seasonId) {
                $q2->where('teams.id', $match->team_2)
                   ->where('team_players.season_id', $seasonId);
            });
        })->count();

        // Обновляем счет только если матч сыгран
        if ($match->status === 'played') {
            $match->update([
                'score_1' => $team1Goals,
                'score_2' => $team2Goals,
            ]);
        }
    }

    /**
     * Получить сезоны по турниру (AJAX)
     */
    public function getSeasonsByTournament(Request $request): JsonResponse
    {
        $tournamentId = $request->get('tournament_id');
        
        if (!$tournamentId) {
            return response()->json([]);
        }

        $seasons = TournamentSeason::where('tournament_id', $tournamentId)
            ->orderBy('year_start', 'desc')
            ->get(['id', 'year_start', 'year_finish']);

        return response()->json($seasons);
    }

    /**
     * Получить стадии по сезону (AJAX)
     */
    public function getStagesBySeason(Request $request): JsonResponse
    {
        $seasonId = $request->get('season_id');
        
        if (!$seasonId) {
            return response()->json([]);
        }

        $stages = TournamentStage::where('tournaments_season_id', $seasonId)
            ->orderBy('stage_order')
            ->get(['id', 'name', 'type']);

        return response()->json($stages);
    }

    /**
     * Получить группы по стадии (AJAX)
     */
    public function getGroupsByStage(Request $request): JsonResponse
    {
        $stageId = $request->get('stage_id');
        
        if (!$stageId) {
            return response()->json([]);
        }

        $groups = TournamentGroup::where('stage_id', $stageId)
            ->orderBy('name')
            ->get(['id', 'name']);

        return response()->json($groups);
    }
}

