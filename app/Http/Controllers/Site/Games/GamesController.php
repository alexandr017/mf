<?php

namespace App\Http\Controllers\Site\Games;

use App\Models\GameCategories\GameCategory;
use App\Models\Games\Game;
use App\Models\StaticPages\StaticPage;
use Illuminate\Http\Request;

class GamesController
{
    public function index()
    {
        // Получаем статическую страницу для SEO
        $page = StaticPage::where('alias', 'games')->first();
        
        // Получаем категории
        $categories = GameCategory::where('status', 1)->orderBy('order')->orderBy('name')->get();
        
        // Получаем игры
        $games = Game::where('status', 1)
            ->with('category')
            ->orderBy('order')
            ->orderBy('name')
            ->get();
        
        // Группируем игры по категориям
        $gamesByCategory = $games->groupBy('category_id');
        
        return view('site.v1.templates.games.index', compact('page', 'categories', 'games', 'gamesByCategory'));
    }

    public function game($id)
    {
        $game = Game::where('id', $id)->where('status', 1)->with('category')->firstOrFail();
        
        return view('site.v1.templates.games.game', compact('game'));
    }
}


