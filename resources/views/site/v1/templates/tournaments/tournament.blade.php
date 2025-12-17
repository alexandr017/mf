@extends('site.v1.layouts.default')

@section('content')
    @include('site.v1.modules.tournaments-banner.tournaments-banner')

    <!-- Tournament Header -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center gap-6 mb-8">
                @if($tournament->image)
                    <div class="w-32 h-32 rounded-lg overflow-hidden border-4 flex-shrink-0" style="border-color: {{ $tournament->color ?? '#7FFF00' }}">
                        <img src="{{ $tournament->image }}" alt="{{ $tournament->name }}" class="w-full h-full object-cover">
                    </div>
                @else
                    <div class="w-32 h-32 rounded-lg overflow-hidden border-4 flex-shrink-0 flex items-center justify-center bg-gradient-to-br from-gray-200 to-gray-300" style="border-color: {{ $tournament->color ?? '#7FFF00' }}">
                        <i class="ri-trophy-line text-6xl text-gray-400"></i>
                    </div>
                @endif
                <div class="flex-1 text-center md:text-left">
                    <h1 class="heading-font text-4xl md:text-5xl text-gray-900 mb-2">{{ $tournament->name }}</h1>
                    @if($tournament->country_name)
                        <p class="text-xl text-gray-600">{{ $tournament->country_name }}</p>
                    @else
                        <p class="text-xl text-gray-600">СНГ</p>
                    @endif
                    @php
                        $typeLabels = [
                            'league' => 'Чемпионат',
                            'cup' => 'Кубок',
                            'supercup' => 'Суперкубок',
                            'mixed' => 'Смешанный'
                        ];
                        $typeLabel = $typeLabels[$tournament->type] ?? $tournament->type;
                    @endphp
                    <span class="inline-block mt-2 px-4 py-1 rounded-full text-sm font-medium" style="background-color: {{ ($tournament->color ?? '#7FFF00') }}33; color: {{ $tournament->color ?? '#7FFF00' }};">
                        {{ $typeLabel }}
                    </span>
                </div>
            </div>
        </div>
    </section>

    <!-- Seasons Section -->
    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h2 class="heading-font text-3xl md:text-4xl text-gray-900 mb-2">История сезонов</h2>
                <p class="text-gray-600">Выберите сезон для просмотра детальной информации, матчей и результатов</p>
            </div>

            @if($seasons->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($seasons as $season)
                        <a href="/tournaments/{{$tournament->id}}/{{$season->id}}" 
                           class="bg-white rounded-lg shadow-lg overflow-hidden border-2 border-gray-100 hover:border-primary transition-all duration-300 card-hover block">
                            <!-- Season Header -->
                            <div class="p-6 border-b-2 border-gray-100" style="border-color: {{ ($tournament->color ?? '#7FFF00') }}33;">
                                <div class="flex items-center justify-between mb-4">
                                    <div>
                                        <h3 class="text-2xl font-bold text-gray-900 mb-1">
                                            {{ $season->year_start }}/{{ $season->year_finish }}
                                        </h3>
                                        <p class="text-sm text-gray-500">Сезон</p>
                                    </div>
                                    <div class="w-16 h-16 rounded-full flex items-center justify-center" style="background-color: {{ ($tournament->color ?? '#7FFF00') }}22;">
                                        <i class="ri-calendar-line text-3xl" style="color: {{ $tournament->color ?? '#7FFF00' }};"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Season Stats -->
                            <div class="p-6">
                                <div class="space-y-4">
                                    <!-- Winner -->
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0" style="background-color: {{ ($tournament->color ?? '#7FFF00') }}22;">
                                            <i class="ri-trophy-fill" style="color: {{ $tournament->color ?? '#7FFF00' }};"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs text-gray-500 mb-1">Победитель</p>
                                            <p class="text-sm font-semibold text-gray-900 truncate">
                                                @if(isset($season->winner_team_id))
                                                    {{-- Здесь будет название команды-победителя --}}
                                                    Команда #{{ $season->winner_team_id }}
                                                @else
                                                    <span class="text-gray-400">Не определен</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Top Scorer -->
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0" style="background-color: {{ ($tournament->color ?? '#7FFF00') }}22;">
                                            <i class="ri-football-line" style="color: {{ $tournament->color ?? '#7FFF00' }};"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs text-gray-500 mb-1">Лучший бомбардир</p>
                                            <p class="text-sm font-semibold text-gray-900 truncate">
                                                @if(isset($season->top_scorer_name))
                                                    {{ $season->top_scorer_name }}
                                                    @if(isset($season->top_scorer_goals))
                                                        <span class="text-gray-500">({{ $season->top_scorer_goals }} голов)</span>
                                                    @endif
                                                @else
                                                    <span class="text-gray-400">Не определен</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Top Assistant -->
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0" style="background-color: {{ ($tournament->color ?? '#7FFF00') }}22;">
                                            <i class="ri-hand-heart-line" style="color: {{ $tournament->color ?? '#7FFF00' }};"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs text-gray-500 mb-1">Лучший ассистент</p>
                                            <p class="text-sm font-semibold text-gray-900 truncate">
                                                @if(isset($season->top_assistant_name))
                                                    {{ $season->top_assistant_name }}
                                                    @if(isset($season->top_assistant_assists))
                                                        <span class="text-gray-500">({{ $season->top_assistant_assists }} передач)</span>
                                                    @endif
                                                @else
                                                    <span class="text-gray-400">Не определен</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Additional Info -->
                                    @if($season->rules_json)
                                        @php
                                            $rules = json_decode($season->rules_json, true);
                                        @endphp
                                        @if(isset($rules['teams']))
                                            <div class="flex items-center gap-3 pt-3 border-t border-gray-100">
                                                <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0" style="background-color: {{ ($tournament->color ?? '#7FFF00') }}22;">
                                                    <i class="ri-team-line" style="color: {{ $tournament->color ?? '#7FFF00' }};"></i>
                                                </div>
                                                <div class="flex-1">
                                                    <p class="text-xs text-gray-500 mb-1">Участников</p>
                                                    <p class="text-sm font-semibold text-gray-900">{{ $rules['teams'] }} команд</p>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                </div>

                                <!-- View Season Button -->
                                <div class="mt-6 pt-4 border-t border-gray-100">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm font-medium" style="color: {{ $tournament->color ?? '#7FFF00' }};">Смотреть сезон</span>
                                        <i class="ri-arrow-right-line text-xl" style="color: {{ $tournament->color ?? '#7FFF00' }};"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-lg shadow-lg p-12 text-center">
                    <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                        <i class="ri-calendar-line text-5xl text-gray-400"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Сезоны пока не добавлены</h3>
                    <p class="text-gray-600">Информация о сезонах этого турнира появится позже</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Tournament Info Section -->
    @if($tournament->content)
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gray-50 rounded-lg p-8">
                <h2 class="heading-font text-3xl text-gray-900 mb-4">О турнире</h2>
                <div class="prose max-w-none text-gray-700">
                    {!! $tournament->content !!}
                </div>
            </div>
        </div>
    </section>
    @endif
@endsection
