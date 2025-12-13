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

//Route::group(['middleware' => ['auth.admin'] ,'prefix' => 'admin', 'as' => 'admin.'], function () {
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::resource('static-pages', StaticPagesController::class)->except(['show']);
    Route::resource('tournaments', TournamentsController::class)->except(['show']);
    Route::resource('tournament-templates', TournamentTemplatesController::class)->except(['show']);
    Route::resource('tournament-seasons', TournamentSeasonsController::class)->except(['show']);
    Route::resource('teams', TeamsController::class)->except(['show']);
    Route::resource('countries', CountriesController::class)->except(['show']);
    Route::resource('cities', CitiesController::class)->except(['show']);
    Route::resource('news', NewsController::class)->except(['show']);
    Route::resource('faq', FAQController::class)->except(['show']);
    Route::resource('users', UsersController::class)->except(['show']);
    Route::get('achievements/{id}/assign-users', [AchievementsController::class, 'assignUsers'])->name('achievements.assign-users');
    Route::patch('achievements/{id}/assign-users', [AchievementsController::class, 'updateAssignedUsers'])->name('achievements.assign-users.update');
    Route::resource('achievements', AchievementsController::class)->except(['show']);

});
