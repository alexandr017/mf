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

Route::get('/', [IndexController::class, 'index']);

Route::get('ratings', [RatingsController::class, 'index']);

Route::get('teams', [TeamsController::class, 'teams']);
Route::get('teams/{alias}', [TeamsController::class, 'team']);

Route::get('players', [PlayersController::class, 'players']);
Route::get('players/{alias}', [PlayersController::class, 'player']);

Route::get('rules', [StaticPagesController::class, 'page']);
Route::get('questions', [FAQController::class, 'questions']);
Route::get('about', [StaticPagesController::class, 'page']);
Route::get('policy', [StaticPagesController::class, 'page']);
Route::get('terms', [StaticPagesController::class, 'page']);

Route::get('tournaments', [TournamentsController::class, 'index']);
Route::get('tournaments/{alias}', [TournamentsController::class, 'tournament']);
Route::get('tournaments/{alias}/season', [TournamentsController::class, 'season']);
Route::get('tournaments/{alias}/{season}/tours', [TournamentsController::class, 'tours']);
Route::get('tournaments/{alias}/tours/{tour}', [TournamentsController::class, 'tour']);
Route::get('tournaments/{alias}/tours/{tour}/{game}', [TournamentsController::class, 'game']);

Route::get('upcoming-games', [UpcomingGamesController::class, 'index']);

Route::get('blog', [NewsController::class, 'list']);
Route::get('blog/{alias}', [NewsController::class, 'post']);

//
//// account
//
Route::get('account', [AccountController::class, 'index']);
Route::get('account/referrals', [AccountController::class, 'referrals']);
Route::get('account/games', [AccountController::class, 'games']);
Route::get('account/games/{alias}', [AccountController::class, 'game']);
Route::get('account/options', [AccountController::class, 'options']);
Route::post('account/options/save', [AccountController::class, 'saveOptions']);


include 'import.php';

//Route::get('online', [OnlineEventsController::class, 'index']);
//// Route::get('/online/{game}', [OnlineEventsController::class, 'game']); // наверно не надо так как есть /tournaments/{alias}/tours/{tour}/{game}
//// game (распределение рейтинга, выдать результат, онлайн (сокеты) 10 мин?)
//
//

//
//// Главная страница
//Route::get('/', [HomeController::class, 'index'])->name('home');
//
//// Клубный рейтинг
//Route::get('/clubs/rating', [ClubController::class, 'rating'])->name('clubs.rating');
//
//// Турниры
//Route::get('/tournaments', [TournamentController::class, 'index'])->name('tournaments.index');
//Route::get('/tournaments/{tournament}', [TournamentController::class, 'show'])->name('tournaments.show');
//
//// Команды
//Route::get('/teams', [TeamController::class, 'index'])->name('teams.index');
//Route::get('/teams/{team}', [TeamController::class, 'show'])->name('teams.show');
//
//// Игроки
//Route::get('/players', [PlayerController::class, 'index'])->name('players.index');
//Route::get('/players/{player}', [PlayerController::class, 'show'])->name('players.show');
//
//// Матчи
//Route::get('/matches/upcoming', [MatchController::class, 'upcoming'])->name('matches.upcoming');
//
//// Новости
//Route::get('/news', [NewsController::class, 'index'])->name('news.index');
//Route::get('/news/{article}', [NewsController::class, 'show'])->name('news.show');
//

