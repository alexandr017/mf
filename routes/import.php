<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Import\ImportTeamsController;
use App\Http\Controllers\Import\ImportStaticPagesController;
use App\Http\Controllers\Import\ImportCitiesController;

Route::get('import/teams', [ImportTeamsController::class, 'index']);
Route::get('import/cities', [ImportCitiesController::class, 'index']);
Route::get('import/static-pages', [ImportStaticPagesController::class, 'index']);
