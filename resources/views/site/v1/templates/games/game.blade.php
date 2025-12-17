@extends('site.v1.layouts.default')
@section('title', $game->name)
@section('meta_description', $game->description)

@section('content')

<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="heading-font text-4xl text-gray-900 mb-4">{{ $game->name }}</h1>
        
        @if($game->description)
            <p class="text-gray-600 mb-6">{{ $game->description }}</p>
        @endif

        @if($game->rules)
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-xl font-bold mb-4">Правила игры</h2>
                <div class="prose max-w-none">
                    {!! nl2br(e($game->rules)) !!}
                </div>
            </div>
        @endif

        <!-- Game Container -->
        <div id="game-container" data-game-id="{{ $game->id }}" data-rating-points="{{ $game->rating_points }}">
            @if($game->id == 1)
                <!-- Крестики-нолики -->
                @include('site.v1.templates.games.tic-tac-toe')
            @else
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <p class="text-gray-600">Игра находится в разработке</p>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection


