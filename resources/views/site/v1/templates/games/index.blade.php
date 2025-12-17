@extends('site.v1.layouts.default')
@section('title', $page->title ?? 'Игры')
@section('meta_description', $page->meta_description ?? '')

@section('content')

    @if($page)
        <div class="container mx-auto px-4 py-8">
            <h1 class="heading-font text-4xl text-gray-900 mb-4">{{ $page->h1 ?? 'Игры' }}</h1>
            @if($page->content)
                <div class="prose max-w-none mb-8">
                    {!! $page->content !!}
                </div>
            @endif
        </div>
    @endif

    <div class="container mx-auto px-4 py-8">
        <!-- Game Categories -->
        <div class="mb-8">
            <div class="flex items-center space-x-4 mb-6 flex-wrap">
                <button class="px-4 py-2 bg-primary bg-opacity-20 text-primary rounded-button text-sm font-medium cursor-pointer game-filter active" data-category="all">Все игры</button>
                @foreach($categories as $category)
                    <button class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-button text-sm font-medium cursor-pointer game-filter" data-category="{{ $category->id }}">{{ $category->name }}</button>
                @endforeach
            </div>
        </div>

        <!-- Games Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="games-grid">
            @foreach($games as $game)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover transition-all duration-300 game-card" data-category="{{ $game->category_id ?? 'none' }}">
                    <div class="h-48 bg-gradient-to-br from-blue-400 to-purple-600 relative overflow-hidden">
                        @if($game->preview)
                            <img src="{{ $game->preview }}" alt="{{ $game->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-white text-4xl">
                                <i class="ri-gamepad-line"></i>
                            </div>
                        @endif
                        <div class="absolute top-4 right-4">
                            <span class="bg-primary text-gray-900 px-2 py-1 rounded-full text-xs font-bold">+{{ $game->rating_points }} XP</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="heading-font text-lg text-gray-900 mb-2">{{ $game->name }}</h3>
                        <p class="text-sm text-gray-600 mb-3">{{ Str::limit($game->description ?? '', 100) }}</p>
                        <a href="{{ route('games.show', $game->id) }}" class="w-full bg-primary hover:bg-opacity-80 text-gray-900 font-bold py-2 px-4 !rounded-button whitespace-nowrap cursor-pointer block text-center">
                            Играть
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.game-filter');
        const gameCards = document.querySelectorAll('.game-card');
        
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const category = this.dataset.category;
                
                filterButtons.forEach(btn => {
                    btn.classList.remove('bg-primary', 'bg-opacity-20', 'text-primary');
                    btn.classList.add('text-gray-600', 'hover:bg-gray-100');
                });
                
                this.classList.add('bg-primary', 'bg-opacity-20', 'text-primary');
                this.classList.remove('text-gray-600', 'hover:bg-gray-100');
                
                gameCards.forEach(card => {
                    if (category === 'all' || card.dataset.category == category) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    });
    </script>
@endsection


