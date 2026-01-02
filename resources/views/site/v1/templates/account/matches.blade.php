@extends('site.v1.layouts.account')

@section('content')
<!-- Page Header -->
<section class="bg-gray-900 py-12 relative overflow-hidden mb-8">
    <div class="absolute inset-0">
        <img src="/v1/images/tournaments-banner.jpg" alt="Matches Background" class="w-full h-full object-cover opacity-30">
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="heading-font text-4xl md:text-5xl text-white mb-4">Мои матчи</h1>
        <p class="text-lg text-gray-200 mb-4 max-w-3xl mx-auto">
            @if($userTeamId)
                Все матчи вашей команды: товарищеские игры и турнирные матчи.
            @else
                Присоединитесь к команде, чтобы видеть матчи вашей команды.
            @endif
        </p>
    </div>
</section>

<!-- Tabs -->
<section class="py-8 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                <button onclick="showTab('old')" id="tab-old" class="tab-button active border-b-2 border-primary text-primary py-4 px-1 text-sm font-medium">
                    Прошедшие
                </button>
                <button onclick="showTab('recent')" id="tab-recent" class="tab-button border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 py-4 px-1 text-sm font-medium">
                    Вчера, сегодня, завтра
                </button>
                <button onclick="showTab('future')" id="tab-future" class="tab-button border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 py-4 px-1 text-sm font-medium">
                    Будущие
                </button>
            </nav>
        </div>
    </div>
</section>

<!-- Matches List -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(!$userTeamId)
            <div class="text-center py-12">
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 max-w-md mx-auto">
                    <i class="ri-information-line text-4xl text-yellow-600 mb-4"></i>
                    <p class="text-lg text-gray-700 mb-4">У вас пока нет команды</p>
                    <p class="text-sm text-gray-600 mb-6">Присоединитесь к команде, чтобы видеть матчи вашей команды.</p>
                    <a href="/teams" class="inline-block bg-primary text-gray-900 font-bold px-6 py-3 rounded-button hover:bg-opacity-80 transition-colors">
                        Выбрать команду
                    </a>
                </div>
            </div>
        @else
        <!-- Old Matches Tab -->
        <div id="tab-content-old" class="tab-content">
            @if($oldMatchesByDate->count() > 0)
                @foreach($oldMatchesByDate as $date => $matches)
                    <div class="mb-12">
                        <h2 class="heading-font text-2xl text-gray-900 mb-6">
                            {{ \Carbon\Carbon::parse($date)->locale('ru')->isoFormat('D MMMM YYYY') }}
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($matches as $matchData)
                                @php
                                    $match = $matchData['match'];
                                    $matchType = $matchData['type'];
                                    $matchUrl = $matchType === 'friendly' ? "/friendly-matches/{$match->id}" : null;
                                    $tournamentName = $matchType === 'tournament' ? ($matchData['tournament']->name ?? 'Турнир') : null;
                                @endphp
                                <div class="relative">
                                    @if($matchType === 'friendly')
                                        <span class="absolute top-2 right-2 bg-blue-500 text-white text-xs font-bold px-2 py-1 rounded z-10">Товарищеская</span>
                                    @elseif($tournamentName)
                                        <span class="absolute top-2 right-2 bg-primary text-gray-900 text-xs font-bold px-2 py-1 rounded z-10">
                                            {{ $tournamentName }}
                                        </span>
                                    @endif
                                    @if($matchUrl)
                                        <a href="{{ $matchUrl }}" class="block">
                                            @include('site.v1.modules.match-card.match-card', ['match' => $match, 'noLink' => true])
                                        </a>
                                    @else
                                        @include('site.v1.modules.match-card.match-card', ['match' => $match, 'noLink' => true])
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-12">
                    <p class="text-xl text-gray-600">Нет прошедших матчей.</p>
                </div>
            @endif
        </div>

        <!-- Recent Matches Tab -->
        <div id="tab-content-recent" class="tab-content" style="display: none;">
            @if($recentMatchesByDate->count() > 0)
                @foreach($recentMatchesByDate as $date => $matches)
                    <div class="mb-12">
                        <h2 class="heading-font text-2xl text-gray-900 mb-6">
                            {{ \Carbon\Carbon::parse($date)->locale('ru')->isoFormat('D MMMM YYYY') }}
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($matches as $matchData)
                                @php
                                    $match = $matchData['match'];
                                    $matchType = $matchData['type'];
                                    $matchUrl = $matchType === 'friendly' ? "/friendly-matches/{$match->id}" : null;
                                    $tournamentName = $matchType === 'tournament' ? ($matchData['tournament']->name ?? 'Турнир') : null;
                                @endphp
                                <div class="relative">
                                    @if($matchType === 'friendly')
                                        <span class="absolute top-2 right-2 bg-blue-500 text-white text-xs font-bold px-2 py-1 rounded z-10">Товарищеская</span>
                                    @elseif($tournamentName)
                                        <span class="absolute top-2 right-2 bg-primary text-gray-900 text-xs font-bold px-2 py-1 rounded z-10">
                                            {{ $tournamentName }}
                                        </span>
                                    @endif
                                    @if($matchUrl)
                                        <a href="{{ $matchUrl }}" class="block">
                                            @include('site.v1.modules.match-card.match-card', ['match' => $match, 'noLink' => true])
                                        </a>
                                    @else
                                        @include('site.v1.modules.match-card.match-card', ['match' => $match, 'noLink' => true])
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-12">
                    <p class="text-xl text-gray-600">Нет матчей за этот период.</p>
                </div>
            @endif
        </div>

        <!-- Future Matches Tab -->
        <div id="tab-content-future" class="tab-content" style="display: none;">
            @if($futureMatchesByDate->count() > 0)
                @foreach($futureMatchesByDate as $date => $matches)
                    <div class="mb-12">
                        <h2 class="heading-font text-2xl text-gray-900 mb-6">
                            {{ \Carbon\Carbon::parse($date)->locale('ru')->isoFormat('D MMMM YYYY') }}
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($matches as $matchData)
                                @php
                                    $match = $matchData['match'];
                                    $matchType = $matchData['type'];
                                    $matchUrl = $matchType === 'friendly' ? "/friendly-matches/{$match->id}" : null;
                                    $tournamentName = $matchType === 'tournament' ? ($matchData['tournament']->name ?? 'Турнир') : null;
                                @endphp
                                <div class="relative">
                                    @if($matchType === 'friendly')
                                        <span class="absolute top-2 right-2 bg-blue-500 text-white text-xs font-bold px-2 py-1 rounded z-10">Товарищеская</span>
                                    @elseif($tournamentName)
                                        <span class="absolute top-2 right-2 bg-primary text-gray-900 text-xs font-bold px-2 py-1 rounded z-10">
                                            {{ $tournamentName }}
                                        </span>
                                    @endif
                                    @if($matchUrl)
                                        <a href="{{ $matchUrl }}" class="block">
                                            @include('site.v1.modules.match-card.match-card', ['match' => $match, 'noLink' => true])
                                        </a>
                                    @else
                                        @include('site.v1.modules.match-card.match-card', ['match' => $match, 'noLink' => true])
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-12">
                    <p class="text-xl text-gray-600">Нет будущих матчей.</p>
                </div>
            @endif
        </div>
        @endif
    </div>
</section>

<script>
function showTab(tabName) {
    // Скрываем все вкладки
    document.querySelectorAll('.tab-content').forEach(content => {
        content.style.display = 'none';
    });
    
    // Убираем активный класс у всех кнопок
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('active', 'border-primary', 'text-primary');
        button.classList.add('border-transparent', 'text-gray-500');
    });
    
    // Показываем выбранную вкладку
    document.getElementById('tab-content-' + tabName).style.display = 'block';
    
    // Активируем кнопку
    const button = document.getElementById('tab-' + tabName);
    button.classList.add('active', 'border-primary', 'text-primary');
    button.classList.remove('border-transparent', 'text-gray-500');
}

// Показываем первую вкладку по умолчанию
document.addEventListener('DOMContentLoaded', function() {
    showTab('old');
});
</script>
@endsection

