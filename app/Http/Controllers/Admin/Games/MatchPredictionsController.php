<?php

namespace App\Http\Controllers\Admin\Games;

use App\Helpers\ActivityLogHelper;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\Games\MatchPredictionRequest;
use App\Models\Games\MatchPrediction;
use App\Repositories\Admin\Games\MatchPredictionRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

final class MatchPredictionsController extends AdminController
{
    protected MatchPredictionRepository $repository;

    public function __construct()
    {
        parent::__construct();
        $this->repository = app(MatchPredictionRepository::class);
    }

    public function index(): View
    {
        $matches = $this->repository->getForShow();
        $breadcrumbs = [['h1' => 'Прогнозы матчей']];
        return view('admin.games.match-predictions.index', compact('matches', 'breadcrumbs'));
    }

    public function create(): View
    {
        $breadcrumbs = [
            ['h1' => 'Прогнозы матчей', 'link' => route('admin.match-predictions.index')],
            ['h1' => 'Создание'],
        ];
        return view('admin.games.match-predictions.create', compact('breadcrumbs'));
    }

    public function store(MatchPredictionRequest $request): RedirectResponse
    {
        $data = $request->all();
        $data = empty_str_to_null($data);
        $item = new MatchPrediction($data);
        $result = $item->save();
        
        if ($result) {
            ActivityLogHelper::logCreate($item);
            return redirect()->route('admin.match-predictions.index')->with('flash_success', 'Матч создан!');
        }
        return redirect()->route('admin.match-predictions.index')->with('flash_errors', 'Ошибка создания!');
    }

    public function edit(string $id): View
    {
        $item = $this->repository->findOrFail($id);
        $breadcrumbs = [
            ['h1' => 'Прогнозы матчей', 'link' => route('admin.match-predictions.index')],
            ['h1' => 'Редактирование'],
        ];
        return view('admin.games.match-predictions.edit', compact('item', 'breadcrumbs'));
    }

    public function update(MatchPredictionRequest $request, string $id): RedirectResponse
    {
        $item = $this->repository->findOrFail($id);
        $data = $request->all();
        $data = empty_str_to_null($data);
        $oldData = $item->getOriginal();
        $result = $item->update($data);
        
        if ($result) {
            // Если матч завершен, обновляем прогнозы пользователей
            if ($item->status === 'finished' && $item->score_1 !== null && $item->score_2 !== null) {
                $this->updateUserPredictions($item);
            }
            
            $changes = array_diff_assoc($item->getAttributes(), $oldData);
            ActivityLogHelper::logUpdate($item, $changes);
            return redirect()->route('admin.match-predictions.index')->with('flash_success', 'Матч обновлен!');
        }
        return redirect()->route('admin.match-predictions.index')->with('flash_errors', 'Ошибка обновления!');
    }

    public function destroy(string $id): RedirectResponse
    {
        $item = $this->repository->findOrFail($id);
        $result = $item->delete();
        
        if ($result) {
            ActivityLogHelper::logDelete($item);
            return redirect()->route('admin.match-predictions.index')->with('flash_success', 'Матч удален!');
        }
        return redirect()->route('admin.match-predictions.index')->with('flash_errors', 'Ошибка удаления!');
    }

    protected function updateUserPredictions(MatchPrediction $match): void
    {
        $result = $match->getResult();
        if (!$result) {
            return;
        }

        DB::beginTransaction();
        try {
            $predictions = $match->userPredictions()->get();
            $ratingReward = 0.001;

            foreach ($predictions as $prediction) {
                $isCorrect = $prediction->prediction === $result;
                $prediction->is_correct = $isCorrect;
                
                if ($isCorrect && $prediction->rating_earned == 0) {
                    $prediction->rating_earned = $ratingReward;
                    $prediction->user->increment('rating', $ratingReward);
                } elseif (!$isCorrect) {
                    $prediction->rating_earned = 0;
                }
                
                $prediction->save();
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}

