<?php

use App\Http\Controllers\Site\FAQ\FAQController;
use App\Http\Controllers\Site\Index\IndexController;
use App\Http\Controllers\Site\Teams\TeamsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\Ratings\RatingsController;
use App\Http\Controllers\Site\Tournaments\TournamentsController;
use App\Http\Controllers\Site\UpcomingGames\UpcomingGamesController;
use App\Http\Controllers\Site\Blog\NewsController;
use App\Http\Controllers\Site\StaticPages\StaticPagesController;
use App\Http\Controllers\Site\Account\AccountController;
use App\Http\Controllers\Site\Players\PlayersController;
use App\Http\Controllers\Site\Games\GamesController;
use App\Http\Controllers\Site\Reports\ReportsController;
use App\Http\Controllers\Site\LiveMatches\LiveMatchesController;
use App\Http\Controllers\ProfileController;

// Главная страница
Route::get('/', [IndexController::class, 'index']);

// Рейтинги
Route::get('ratings', [RatingsController::class, 'index']);

// Команды
Route::get('teams', [TeamsController::class, 'teams']);
Route::get('teams/{alias}', [TeamsController::class, 'team']);
Route::post('teams/{alias}/join', [TeamsController::class, 'joinTeam'])->middleware('auth')->name('teams.join');
Route::post('teams/{alias}/leave', [TeamsController::class, 'leaveTeam'])->middleware('auth')->name('teams.leave');

// Игроки
Route::get('players', [PlayersController::class, 'players']);
Route::get('players/api', [PlayersController::class, 'api'])->name('players.api');
Route::get('players/{alias}', [PlayersController::class, 'player']);

// Статические страницы
Route::get('rules', [StaticPagesController::class, 'page']);
Route::get('questions', [FAQController::class, 'questions']);
Route::get('about', [StaticPagesController::class, 'page']);
Route::get('policy', [StaticPagesController::class, 'page']);
Route::get('terms', [StaticPagesController::class, 'page']);

// Турниры
Route::get('tournaments', [TournamentsController::class, 'index']);

// Товарищеские матчи (детальный просмотр)
Route::get('friendly-matches/{id}', [\App\Http\Controllers\Site\FriendlyMatches\FriendlyMatchesController::class, 'show'])->name('friendly-matches.show');
Route::get('tournaments/{alias}', [TournamentsController::class, 'tournament']);
Route::get('tournaments/{alias}/{season}', [TournamentsController::class, 'season']);
Route::get('tournaments/{alias}/{season}/tours', [TournamentsController::class, 'tours']);
Route::get('tournaments/{alias}/tours/{tour}', [TournamentsController::class, 'tour']);
Route::get('tournaments/{alias}/tours/{tour}/{game}', [TournamentsController::class, 'game']);

// Предстоящие игры
Route::get('upcoming-games', [UpcomingGamesController::class, 'index']);

// Live матчи
Route::get('live-matches/{matchId}', [LiveMatchesController::class, 'show'])->name('live-matches.show');
Route::get('live-matches/{matchId}/state', [LiveMatchesController::class, 'getState'])->name('live-matches.state');

// Блог
Route::get('blog', [NewsController::class, 'list']);
Route::get('blog/{alias}', [NewsController::class, 'post']);

// Жалобы
Route::post('reports', [ReportsController::class, 'store'])->name('reports.store');

// Личный кабинет (требует авторизации)
Route::middleware('auth')->group(function () {
    Route::get('account', [AccountController::class, 'index'])->name('account');
    Route::get('account/referrals', [AccountController::class, 'referrals'])->name('account.referrals');
    Route::get('account/games', [AccountController::class, 'games'])->name('account.games');
    Route::get('account/games/{alias}', [AccountController::class, 'game'])->name('account.game');
    Route::get('account/matches', [AccountController::class, 'matches'])->name('account.matches');
    Route::get('account/options', [AccountController::class, 'options'])->name('account.options');
    Route::post('account/options', [AccountController::class, 'saveOptions'])->name('account.options.save');
    
    // Тикеты
    Route::get('account/tickets', [\App\Http\Controllers\Site\Tickets\TicketsController::class, 'index'])->name('account.tickets.index');
    Route::get('account/tickets/create', [\App\Http\Controllers\Site\Tickets\TicketsController::class, 'create'])->name('account.tickets.create');
    Route::post('account/tickets', [\App\Http\Controllers\Site\Tickets\TicketsController::class, 'store'])->name('account.tickets.store');
    Route::get('account/tickets/{id}', [\App\Http\Controllers\Site\Tickets\TicketsController::class, 'show'])->name('account.tickets.show');
    Route::post('account/tickets/{id}/message', [\App\Http\Controllers\Site\Tickets\TicketsController::class, 'addMessage'])->name('account.tickets.add-message');
    Route::get('account/tickets/{id}/check-messages', [\App\Http\Controllers\Site\Tickets\TicketsController::class, 'checkNewMessages'])->name('account.tickets.check-messages');
    
    // Уведомления
    Route::get('notifications', [\App\Http\Controllers\Site\Notifications\NotificationsController::class, 'index'])->name('notifications.index');
    Route::get('notifications/unread-count', [\App\Http\Controllers\Site\Notifications\NotificationsController::class, 'unreadCount'])->name('notifications.unread-count');
    Route::post('notifications/{id}/read', [\App\Http\Controllers\Site\Notifications\NotificationsController::class, 'markAsRead'])->name('notifications.mark-read');
    Route::post('notifications/mark-all-read', [\App\Http\Controllers\Site\Notifications\NotificationsController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
    
    // Мини-игры
    Route::get('games/penalty-training', [\App\Http\Controllers\Site\Games\PenaltyTrainingController::class, 'index'])->name('games.penalty-training');
    Route::post('games/penalty-training/play', [\App\Http\Controllers\Site\Games\PenaltyTrainingController::class, 'play'])->name('games.penalty-training.play');
    Route::get('games/match-predictions', [\App\Http\Controllers\Site\Games\MatchPredictionsController::class, 'index'])->name('games.match-predictions');
    Route::post('games/match-predictions/{matchId}/predict', [\App\Http\Controllers\Site\Games\MatchPredictionsController::class, 'predict'])->name('games.match-predictions.predict');
    Route::get('games/keepie-uppie', [\App\Http\Controllers\Site\Games\KeepieUppieController::class, 'index'])->name('games.keepie-uppie');
    Route::post('games/keepie-uppie/play', [\App\Http\Controllers\Site\Games\KeepieUppieController::class, 'play'])->name('games.keepie-uppie.play');

    // Профиль Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Dashboard (требует авторизации и подтверждения email)
Route::get('/dashboard', function () {
    return redirect()->route('account');
})->middleware(['auth', 'verified'])->name('dashboard');

require 'auth.php';
include 'admin.php';
include 'import.php';
