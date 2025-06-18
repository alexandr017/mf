<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\IndexController;
use App\Http\Controllers\Site\FAQController;
use App\Http\Controllers\Site\TeamsController;

Route::get('/teams', [TeamsController::class, 'teams']);
Route::get('/teams/{alias}', [TeamsController::class, 'team']);

Route::get('/faq', [FAQController::class, 'faq']);

Route::get('/', [IndexController::class, 'index']);

