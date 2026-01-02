@extends('site.v1.layouts.account')

@section('title', 'Прогноз матчей')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="heading-font text-4xl text-gray-900 mb-2">Прогноз матчей</h1>
        <p class="text-gray-600">Угадайте исходы матчей на ближайшие 7 дней и зарабатывайте рейтинг! За каждый правильный прогноз +0.001 балл.</p>
    </div>

    <!-- Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-lg p-6 border-2 border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Всего прогнозов</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalPredictions }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="ri-file-list-3-line text-blue-600 text-2xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6 border-2 border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Угадано</p>
                    <p class="text-3xl font-bold text-primary">{{ $correctPredictions }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="ri-checkbox-circle-fill text-green-600 text-2xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6 border-2 border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Заработано рейтинга</p>
                    <p class="text-3xl font-bold text-secondary">+{{ number_format($totalRatingEarned, 3) }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                    <i class="ri-star-fill text-yellow-600 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Matches List -->
    <div class="space-y-6">
        @forelse($matches as $match)
            <div class="bg-white rounded-xl shadow-lg p-6 border-2 border-gray-100 hover:border-primary transition-all duration-300" data-match-id="{{ $match->id }}">
                <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                    <!-- Match Info -->
                    <div class="flex-1 flex items-center justify-center gap-8 w-full md:w-auto min-w-0">
                        <!-- Team 1 -->
                        <div class="flex flex-col items-center text-center flex-shrink-0" style="width: 150px;">
                            <div class="w-20 h-20 bg-gray-200 rounded-full mb-3 flex items-center justify-center overflow-hidden flex-shrink-0">
                                @if($match->team_1_logo)
                                    <img src="{{ $match->team_1_logo }}" alt="{{ $match->team_1_name }}" class="w-full h-full object-cover">
                                @else
                                    <i class="ri-team-line text-3xl text-gray-400"></i>
                                @endif
                            </div>
                            <h3 class="font-bold text-gray-900 text-lg truncate w-full" title="{{ $match->team_1_name }}">{{ $match->team_1_name }}</h3>
                        </div>

                        <!-- VS / Score -->
                        <div class="flex flex-col items-center flex-shrink-0" style="width: 120px;">
                            @if($match->status === 'finished' && $match->score_1 !== null && $match->score_2 !== null)
                                <div class="text-4xl font-bold text-gray-900 mb-2">
                                    {{ $match->score_1 }} - {{ $match->score_2 }}
                                </div>
                                <span class="text-sm text-gray-500">Завершен</span>
                            @else
                                <div class="text-2xl font-bold text-gray-400 mb-2">VS</div>
                                <div class="text-sm text-gray-500 text-center">
                                    <div>{{ $match->match_date->format('d.m.Y') }}</div>
                                    <div>{{ $match->match_date->format('H:i') }}</div>
                                </div>
                            @endif
                        </div>

                        <!-- Team 2 -->
                        <div class="flex flex-col items-center text-center flex-shrink-0" style="width: 150px;">
                            <div class="w-20 h-20 bg-gray-200 rounded-full mb-3 flex items-center justify-center overflow-hidden flex-shrink-0">
                                @if($match->team_2_logo)
                                    <img src="{{ $match->team_2_logo }}" alt="{{ $match->team_2_name }}" class="w-full h-full object-cover">
                                @else
                                    <i class="ri-team-line text-3xl text-gray-400"></i>
                                @endif
                            </div>
                            <h3 class="font-bold text-gray-900 text-lg truncate w-full" title="{{ $match->team_2_name }}">{{ $match->team_2_name }}</h3>
                        </div>
                    </div>

                    <!-- Prediction Section -->
                    <div class="flex flex-col items-center gap-4 flex-shrink-0" style="min-width: 280px;">
                        @if(isset($userPredictions[$match->id]))
                            @php
                                $userPrediction = $userPredictions[$match->id];
                                $predictionText = [
                                    'team_1' => 'Победа ' . $match->team_1_name,
                                    'draw' => 'Ничья',
                                    'team_2' => 'Победа ' . $match->team_2_name
                                ];
                            @endphp
                            <div class="bg-primary bg-opacity-10 rounded-lg p-4 text-center min-w-[200px]">
                                <p class="text-sm text-gray-600 mb-2">Ваш прогноз:</p>
                                <p class="font-bold text-primary text-lg">{{ $predictionText[$userPrediction] }}</p>
                                @if($match->status === 'finished')
                                    @php
                                        $userPredictionObj = \App\Models\Games\MatchPredictionUser::where('user_id', auth()->id())
                                            ->where('match_id', $match->id)
                                            ->first();
                                    @endphp
                                    @if($userPredictionObj && $userPredictionObj->is_correct !== null)
                                        @if($userPredictionObj->is_correct)
                                            <div class="mt-2 flex items-center justify-center gap-2 text-green-600">
                                                <i class="ri-checkbox-circle-fill"></i>
                                                <span class="font-semibold">Угадали! +{{ number_format($userPredictionObj->rating_earned, 3) }}</span>
                                            </div>
                                        @else
                                            <div class="mt-2 flex items-center justify-center gap-2 text-red-600">
                                                <i class="ri-close-circle-fill"></i>
                                                <span class="font-semibold">Не угадали</span>
                                            </div>
                                        @endif
                                    @endif
                                @endif
                            </div>
                        @elseif($match->canPredict())
                            <div class="flex gap-2 w-full justify-center">
                                <button class="prediction-btn bg-white hover:bg-gray-100 border-2 border-gray-300 hover:border-primary text-gray-900 font-bold px-3 py-3 rounded-button transition-all duration-300 flex-1 max-w-[90px]" 
                                        data-match-id="{{ $match->id }}" 
                                        data-prediction="team_1"
                                        onclick="makePrediction({{ $match->id }}, 'team_1')">
                                    <div class="flex flex-col items-center">
                                        <i class="ri-trophy-line text-xl mb-1"></i>
                                        <span class="text-xs truncate w-full text-center" title="{{ $match->team_1_name }}">{{ $match->team_1_name }}</span>
                                    </div>
                                </button>
                                <button class="prediction-btn bg-white hover:bg-gray-100 border-2 border-gray-300 hover:border-primary text-gray-900 font-bold px-3 py-3 rounded-button transition-all duration-300 flex-1 max-w-[80px]" 
                                        data-match-id="{{ $match->id }}" 
                                        data-prediction="draw"
                                        onclick="makePrediction({{ $match->id }}, 'draw')">
                                    <div class="flex flex-col items-center">
                                        <i class="ri-equalizer-line text-xl mb-1"></i>
                                        <span class="text-xs">Ничья</span>
                                    </div>
                                </button>
                                <button class="prediction-btn bg-white hover:bg-gray-100 border-2 border-gray-300 hover:border-primary text-gray-900 font-bold px-3 py-3 rounded-button transition-all duration-300 flex-1 max-w-[90px]" 
                                        data-match-id="{{ $match->id }}" 
                                        data-prediction="team_2"
                                        onclick="makePrediction({{ $match->id }}, 'team_2')">
                                    <div class="flex flex-col items-center">
                                        <i class="ri-trophy-line text-xl mb-1"></i>
                                        <span class="text-xs truncate w-full text-center" title="{{ $match->team_2_name }}">{{ $match->team_2_name }}</span>
                                    </div>
                                </button>
                            </div>
                            <p class="text-xs text-gray-500 text-center">
                                Дедлайн: {{ $match->prediction_deadline->format('d.m.Y H:i') }}
                            </p>
                        @else
                            <div class="bg-gray-100 rounded-lg p-4 text-center w-full" style="min-width: 280px;">
                                <p class="text-sm text-gray-500">Прогнозы закрыты</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                <i class="ri-inbox-line text-6xl text-gray-400 mb-4"></i>
                <p class="text-xl text-gray-600 mb-2">Нет доступных матчей</p>
                <p class="text-gray-500">На ближайшие 7 дней нет матчей для прогнозирования</p>
            </div>
        @endforelse
    </div>
</div>

<script>
function makePrediction(matchId, prediction) {
    if (!confirm('Вы уверены в своем прогнозе? Изменить его будет невозможно.')) {
        return;
    }

    const button = document.querySelector(`[data-match-id="${matchId}"][data-prediction="${prediction}"]`);
    if (!button) return;

    button.disabled = true;
    button.classList.add('opacity-50', 'cursor-not-allowed');

    fetch(`/games/match-predictions/${matchId}/predict`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            prediction: prediction
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Прогноз сохранен!');
            window.location.reload();
        } else {
            alert(data.message || 'Произошла ошибка');
            button.disabled = false;
            button.classList.remove('opacity-50', 'cursor-not-allowed');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Произошла ошибка при отправке прогноза');
        button.disabled = false;
        button.classList.remove('opacity-50', 'cursor-not-allowed');
    });
}
</script>

<style>
.prediction-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.prediction-btn:active {
    transform: translateY(0);
}
</style>
@endsection

