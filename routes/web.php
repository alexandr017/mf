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
use App\Http\Controllers\ProfileController;

// Главная страница
Route::get('/', [IndexController::class, 'index']);

// Рейтинги
Route::get('ratings', [RatingsController::class, 'index']);

// Команды
Route::get('teams', [TeamsController::class, 'teams']);
Route::get('teams/{alias}', [TeamsController::class, 'team']);

// Игроки
Route::get('players', [PlayersController::class, 'players']);
Route::get('players/{alias}', [PlayersController::class, 'player']);

// Статические страницы
Route::get('rules', [StaticPagesController::class, 'page']);
Route::get('questions', [FAQController::class, 'questions']);
Route::get('about', [StaticPagesController::class, 'page']);
Route::get('policy', [StaticPagesController::class, 'page']);
Route::get('terms', [StaticPagesController::class, 'page']);

// Турниры
Route::get('tournaments', [TournamentsController::class, 'index']);
Route::get('tournaments/{alias}', [TournamentsController::class, 'tournament']);
Route::get('tournaments/{alias}/{season}', [TournamentsController::class, 'season']);
Route::get('tournaments/{alias}/{season}/tours', [TournamentsController::class, 'tours']);
Route::get('tournaments/{alias}/tours/{tour}', [TournamentsController::class, 'tour']);
Route::get('tournaments/{alias}/tours/{tour}/{game}', [TournamentsController::class, 'game']);

// Предстоящие игры
Route::get('upcoming-games', [UpcomingGamesController::class, 'index']);

// Блог
Route::get('blog', [NewsController::class, 'list']);
Route::get('blog/{alias}', [NewsController::class, 'post']);

// Личный кабинет (требует авторизации)
Route::middleware('auth')->group(function () {
    Route::get('account', [AccountController::class, 'index'])->name('account');
    Route::get('account/referrals', [AccountController::class, 'referrals'])->name('account.referrals');
    Route::get('account/games', [AccountController::class, 'games'])->name('account.games');
    Route::get('account/games/{alias}', [AccountController::class, 'game'])->name('account.game');
    Route::get('account/options', [AccountController::class, 'options'])->name('account.options');
    Route::post('account/options', [AccountController::class, 'saveOptions'])->name('account.options.save');

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
