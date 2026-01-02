<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StaticPages\StaticPagesController;
use App\Http\Controllers\Admin\Tournaments\TournamentsController;
use App\Http\Controllers\Admin\TournamentTemplates\TournamentTemplatesController;
use App\Http\Controllers\Admin\TournamentSeasons\TournamentSeasonsController;
use App\Http\Controllers\Admin\Teams\TeamsController;
use App\Http\Controllers\Admin\Countries\CountriesController;
use App\Http\Controllers\Admin\Cities\CitiesController;
use App\Http\Controllers\Admin\News\NewsController;
use App\Http\Controllers\Admin\FAQ\FAQController;
use App\Http\Controllers\Admin\Users\UsersController;
use App\Http\Controllers\Admin\Achievements\AchievementsController;
use App\Http\Controllers\Admin\Games\GamesController;
use App\Http\Controllers\Admin\GameCategories\GameCategoriesController;
use App\Http\Controllers\Admin\Matches\MatchesController;
use App\Http\Controllers\Admin\ActivityLogs\ActivityLogsController;
use App\Http\Controllers\Admin\UserGameResults\UserGameResultsController;
use App\Http\Controllers\Admin\Tickets\TicketsController;
use App\Http\Controllers\Admin\RatingHistory\RatingHistoryController;
use App\Http\Controllers\Admin\TeamPlayers\TeamPlayersController;
use App\Http\Controllers\Admin\Referrals\ReferralsController;
use App\Http\Controllers\Admin\Reports\ReportsController;
use App\Http\Controllers\Admin\FriendlyMatches\FriendlyMatchesController;

Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::resource('static-pages', StaticPagesController::class)->except(['show']);
    Route::resource('tournaments', TournamentsController::class)->except(['show']);
    Route::resource('tournament-templates', TournamentTemplatesController::class)->except(['show']);
    Route::resource('tournament-seasons', TournamentSeasonsController::class)->except(['show']);
    Route::resource('matches', MatchesController::class);
    Route::get('matches/seasons-by-tournament', [MatchesController::class, 'getSeasonsByTournament'])->name('matches.seasons-by-tournament');
    Route::get('matches/stages-by-season', [MatchesController::class, 'getStagesBySeason'])->name('matches.stages-by-season');
    Route::post('matches/{id}/start-live', [MatchesController::class, 'startLiveMatch'])->name('matches.start-live');
    Route::post('matches/{id}/stop-live', [MatchesController::class, 'stopLiveMatch'])->name('matches.stop-live');
    Route::get('matches/groups-by-stage', [MatchesController::class, 'getGroupsByStage'])->name('matches.groups-by-stage');
    Route::post('matches/{id}/add-event', [MatchesController::class, 'addEvent'])->name('matches.add-event');
    Route::delete('matches/{matchId}/events/{eventId}', [MatchesController::class, 'deleteEvent'])->name('matches.delete-event');
    Route::resource('teams', TeamsController::class)->except(['show']);
    Route::get('teams/cities-by-country', [TeamsController::class, 'getCitiesByCountry'])->name('teams.cities-by-country');
    Route::resource('countries', CountriesController::class)->except(['show']);
    Route::resource('cities', CitiesController::class)->except(['show']);
    Route::resource('news', NewsController::class)->except(['show']);
    Route::resource('faq', FAQController::class)->except(['show']);
    Route::resource('users', UsersController::class)->except(['show']);
    Route::get('users/data', [UsersController::class, 'dataTables'])->name('users.data');
    Route::get('achievements/{id}/assign-users', [AchievementsController::class, 'assignUsers'])->name('achievements.assign-users');
    Route::patch('achievements/{id}/assign-users', [AchievementsController::class, 'updateAssignedUsers'])->name('achievements.assign-users.update');
    Route::resource('achievements', AchievementsController::class)->except(['show']);
    Route::resource('games', GamesController::class)->except(['show']);
    Route::resource('game-categories', GameCategoriesController::class)->except(['show']);
    Route::get('activity-logs', [ActivityLogsController::class, 'index'])->name('activity-logs.index');
    Route::get('activity-logs/data', [ActivityLogsController::class, 'dataTables'])->name('activity-logs.data');
    Route::get('activity-logs/search-users', [ActivityLogsController::class, 'searchUsers'])->name('activity-logs.search-users');
    Route::get('user-game-results', [UserGameResultsController::class, 'index'])->name('user-game-results.index');
    Route::get('user-game-results/data', [UserGameResultsController::class, 'dataTables'])->name('user-game-results.data');
    Route::get('user-game-results/search-users', [UserGameResultsController::class, 'searchUsers'])->name('user-game-results.search-users');
    Route::get('tickets/data', [TicketsController::class, 'dataTables'])->name('tickets.data');
    Route::get('tickets/search-users', [TicketsController::class, 'searchUsers'])->name('tickets.search-users');
    Route::post('tickets/{id}/add-message', [TicketsController::class, 'addMessage'])->name('tickets.add-message');
    Route::resource('tickets', TicketsController::class);
    Route::get('rating-history', [RatingHistoryController::class, 'index'])->name('rating-history.index');
    Route::get('rating-history/search-users', [RatingHistoryController::class, 'searchUsers'])->name('rating-history.search-users');
    Route::resource('team-players', TeamPlayersController::class)->except(['show']);
    Route::get('referrals', [ReferralsController::class, 'index'])->name('referrals.index');
    Route::get('referrals/data', [ReferralsController::class, 'dataTables'])->name('referrals.data');
    Route::get('referrals/search-users', [ReferralsController::class, 'searchUsers'])->name('referrals.search-users');

    Route::resource('reports', ReportsController::class)->except(['show']);

    Route::resource('friendly-matches', FriendlyMatchesController::class);

});
