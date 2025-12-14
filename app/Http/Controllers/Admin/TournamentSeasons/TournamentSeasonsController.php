<?php

namespace App\Http\Controllers\Admin\TournamentSeasons;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\TournamentSeasons\TournamentSeasonRequest;
use App\Models\Tournaments\Tournament;
use App\Models\Tournaments\TournamentSeason;
use App\Models\Tournaments\TournamentTemplate;
use App\Models\Teams\Team;
use App\Repositories\Admin\TournamentSeasons\TournamentSeasonRepository;
use App\Services\Tournaments\TournamentGeneratorFactory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class TournamentSeasonsController extends AdminController
{
    protected TournamentSeasonRepository $seasonRepository;

    public function __construct()
    {
        parent::__construct();
        $this->seasonRepository = app(TournamentSeasonRepository::class);
    }

    public function index(Request $request): View
    {
        $tournamentId = $request->get('tournament_id');
        $seasons = $this->seasonRepository->getForShow($tournamentId);
        $tournaments = Tournament::orderBy('name')->get();

        $breadcrumbs = [['h1' => 'Сезоны турниров']];

        return view('admin.tournament-seasons.index', compact('seasons', 'tournaments', 'tournamentId', 'breadcrumbs'));
    }

    public function create(Request $request): View
    {
        $tournamentId = $request->get('tournament_id');
        $tournaments = Tournament::orderBy('name')->get();
        $templates = TournamentTemplate::orderBy('name')->get();
        $teams = Team::orderBy('name')->get();
        $breadcrumbs = [
            ['h1' => 'Сезоны турниров', 'link' => route('admin.tournament-seasons.index')],
            ['h1' => 'Создание'],
        ];

        return view('admin.tournament-seasons.create', compact('tournaments', 'templates', 'teams', 'tournamentId', 'breadcrumbs'));
    }

    public function store(TournamentSeasonRequest $request): RedirectResponse
    {
        $data = $request->all();

        $data = empty_str_to_null($data);

        $season = new TournamentSeason($data);
        $result = $season->save();

        if (!$result) {
            return redirect()
                ->route('admin.tournament-seasons.index')
                ->with('flash_errors', 'Ошибка создания сезона!');
        }

        // Генерация матчей, если указаны команды и шаблон
        if ($request->has('generate_matches') && $request->get('generate_matches') == '1') {
            $tournament = Tournament::findOrFail($data['tournament_id']);
            $template = $tournament->template;

            if ($template && $request->has('teams') && is_array($request->get('teams'))) {
                try {
                    $teams = $request->get('teams');
                    $startDate = new \DateTime($request->get('start_date', 'now'));

                    $generator = TournamentGeneratorFactory::create($template);
                    $generator->generate($season, $template, $teams, $startDate);

                    return redirect()
                        ->route('admin.tournament-seasons.index', ['tournament_id' => $data['tournament_id']])
                        ->with('flash_success', 'Сезон создан и матчи сгенерированы!');
                } catch (\Exception $e) {
                    return redirect()
                        ->route('admin.tournament-seasons.index', ['tournament_id' => $data['tournament_id']])
                        ->with('flash_errors', 'Сезон создан, но ошибка генерации матчей: ' . $e->getMessage());
                }
            }
        }

        return redirect()
            ->route('admin.tournament-seasons.index', ['tournament_id' => $data['tournament_id']])
            ->with('flash_success', 'Сезон создан!');
    }

    public function edit(string $id): View
    {
        $item = $this->seasonRepository->findOrFail($id);
        $tournaments = Tournament::orderBy('name')->get();
        $templates = TournamentTemplate::orderBy('name')->get();
        $teams = Team::orderBy('name')->get();
        $breadcrumbs = [
            ['h1' => 'Сезоны турниров', 'link' => route('admin.tournament-seasons.index')],
            ['h1' => 'Редактирование'],
        ];

        return view('admin.tournament-seasons.edit', compact('item', 'tournaments', 'templates', 'teams', 'breadcrumbs'));
    }

    public function update(TournamentSeasonRequest $request, string $id): RedirectResponse
    {
        $item = $this->seasonRepository->findOrFail($id);

        $data = $request->all();
        $data = empty_str_to_null($data);

        $result = $item->update($data);

        if ($result) {
            return redirect()
                ->route('admin.tournament-seasons.index', ['tournament_id' => $item->tournament_id])
                ->with('flash_success', 'Сезон обновлен!');
        }

        return redirect()
            ->route('admin.tournament-seasons.index', ['tournament_id' => $item->tournament_id])
            ->with('flash_errors', 'Ошибка обновления!');
    }

    public function destroy(string $id): RedirectResponse
    {
        $item = $this->seasonRepository->findOrFail($id);
        $tournamentId = $item->tournament_id;

        $result = $item->delete();

        if ($result) {
            return redirect()
                ->route('admin.tournament-seasons.index', ['tournament_id' => $tournamentId])
                ->with('flash_success', 'Сезон удален!');
        }

        return redirect()
            ->route('admin.tournament-seasons.index', ['tournament_id' => $tournamentId])
            ->with('flash_errors', 'Ошибка удаления!');
    }
}


