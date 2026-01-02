<?php

namespace App\Console\Commands;

use App\Models\LiveMatches\LiveMatch;
use App\Services\LiveMatches\MatchStateService;
use Illuminate\Console\Command;

class ProcessLiveMatches extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'live-matches:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process live matches - update state and save finished matches';

    protected MatchStateService $matchStateService;

    public function __construct(MatchStateService $matchStateService)
    {
        parent::__construct();
        $this->matchStateService = $matchStateService;
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        // Находим все активные матчи
        $liveMatches = LiveMatch::where('status', 'live')
            ->where('ends_at', '>', now())
            ->get();

        foreach ($liveMatches as $liveMatch) {
            // Обновляем состояние
            $this->matchStateService->updateMatchState($liveMatch);
        }

        // Обрабатываем завершенные матчи
        $finishedMatches = LiveMatch::where('status', 'live')
            ->where('ends_at', '<=', now())
            ->where('result_saved', false)
            ->get();

        foreach ($finishedMatches as $liveMatch) {
            $this->matchStateService->saveMatchResult($liveMatch);
            $this->info("Match {$liveMatch->match_id} result saved");
        }

        return Command::SUCCESS;
    }
}


