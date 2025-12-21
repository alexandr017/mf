@extends('site.v1.layouts.default')
{{--@section ('title', Shortcode::compile($page->title))--}}
{{--@section ('meta_description', Shortcode::compile($page->meta_description))--}}

@section('content')
    @include('site.v1.modules.tournaments-banner.tournaments-banner')

<!-- Current Tournaments Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="heading-font text-4xl md:text-5xl text-gray-900 mb-6">Current Tournaments</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">These prestigious tournaments are currently accepting teams from across Russia and beyond. Each trophy represents the pinnacle of ridiculous football achievement.</p>
        </div>

        @foreach($tournaments as $countryId => $countryTournaments)
            @php
                $firstTournament = $countryTournaments->first();
                $countryName = $firstTournament->country_name ?? 'International';
                $borderColor = $firstTournament->color ?? '#7FFF00';
            @endphp
            <div class="mb-20">
                <div class="flex items-center justify-center mb-12">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-full overflow-hidden border-4" style="border-color: {{ $borderColor }}">
                            @if($countryId === 'null' || $countryId === null)
                                <div class="w-full h-full bg-gradient-to-br from-green-400 to-blue-500 flex items-center justify-center text-white font-bold text-xs">СНГ</div>
                            @elseif($countryId == 1)
                                <div class="w-full h-full bg-gradient-to-br from-blue-500 via-white to-red-500 flex items-center justify-center"></div>
                            @elseif($countryId == 2)
                                <div class="w-full h-full bg-gradient-to-br from-red-600 via-green-500 to-red-600 flex items-center justify-center"></div>
                            @elseif($countryId == 3)
                                <div class="w-full h-full bg-gradient-to-br from-blue-400 to-yellow-400 flex items-center justify-center"></div>
                            @elseif($countryId == 4)
                                <div class="w-full h-full bg-gradient-to-br from-red-600 via-blue-500 to-orange-500 flex items-center justify-center"></div>
                            @else
                                <div class="w-full h-full bg-gray-300 flex items-center justify-center"></div>
                            @endif
                        </div>
                        <h3 class="heading-font text-3xl md:text-4xl text-gray-900">{{ $countryName }}</h3>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach($countryTournaments as $tournament)
                        @php
                            $tournamentColor = $tournament->color ?? '#7FFF00';
                            $typeLabels = [
                                'league' => 'Чемпионат',
                                'cup' => 'Кубок',
                                'supercup' => 'Суперкубок',
                                'mixed' => 'Смешанный'
                            ];
                            $typeLabel = $typeLabels[$tournament->type] ?? $tournament->type;
                        @endphp
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden border-2 border-gray-100 transition-all duration-300 card-hover trophy-card cursor-pointer"
                             style="border-color: {{ $tournamentColor }};"
                             onmouseover="this.style.borderColor='{{ $tournamentColor }}'; this.style.boxShadow='0 0 0 3px {{ $tournamentColor }}33';"
                             onmouseout="this.style.borderColor='#e5e7eb'; this.style.boxShadow='';">
                            <a href="/tournaments/{{ $tournament->id }}">
                                <div class="p-8 text-center">
                                    <div class="w-32 h-32 mx-auto mb-6 trophy-glow">
                                        @if($tournament->image)
                                            <img src="{{ $tournament->image }}" alt="{{ $tournament->name }}" class="w-full h-full object-cover object-top">
                                        @else
                                            <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 rounded-full flex items-center justify-center">
                                                <i class="ri-trophy-line text-5xl text-gray-400"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <h4 class="heading-font text-xl text-gray-900 mb-2">{{ $tournament->name }}</h4>
                                    <p class="text-gray-600 text-sm mb-4">{{ $typeLabel }}</p>
                                    <div class="space-y-2 text-sm">
                                        <div class="flex justify-between">
                                            <span class="text-gray-500">Teams:</span>
                                            <span class="font-bold">{{ $tournament->participants_count }}</span>
                                        </div>
                                    </div>
                                    <button class="w-full mt-4 font-bold py-2 !rounded-button whitespace-nowrap cursor-pointer transition-colors"
                                            style="background-color: {{ $tournamentColor }}; color: {{ $tournamentColor == '#7FFF00' ? '#1f2937' : 'white' }};"
                                            onmouseover="this.style.opacity='0.8';"
                                            onmouseout="this.style.opacity='1';">
                                        Join Tournament
                                    </button>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</section>

<!-- Tournament Categories -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="heading-font text-4xl text-gray-900 mb-4">Категории турниров</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Различные кубки для каждой команды.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Международные турниры -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center card-hover transition-all duration-300 cursor-pointer">
                <div class="w-16 h-16 mx-auto mb-4 bg-primary bg-opacity-10 rounded-full flex items-center justify-center">
                    <div class="w-8 h-8 text-primary">
                        <i class="ri-global-line ri-lg"></i>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Международные турниры</h3>
                <p class="text-gray-600 mb-4">Турниры между странами</p>
                <div class="text-2xl font-bold text-primary mb-2">1</div>
                <div class="text-sm text-gray-500">Турнир</div>
            </div>

            <!-- Страны -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center card-hover transition-all duration-300 cursor-pointer">
                <div class="w-16 h-16 mx-auto mb-4 bg-secondary bg-opacity-10 rounded-full flex items-center justify-center">
                    <div class="w-8 h-8 text-secondary">
                        <i class="ri-map-pin-2-line ri-lg"></i>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Страны</h3>
                <p class="text-gray-600 mb-4">Национальные чемпионаты</p>
                <div class="text-2xl font-bold text-secondary mb-2">4</div>
                <div class="text-sm text-gray-500">Страны</div>
            </div>

            <!-- Турниры стран -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center card-hover transition-all duration-300 cursor-pointer">
                <div class="w-16 h-16 mx-auto mb-4 bg-yellow-100 rounded-full flex items-center justify-center">
                    <div class="w-8 h-8 text-yellow-600">
                        <i class="ri-trophy-line ri-lg"></i>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Турниры стран</h3>
                <p class="text-gray-600 mb-4">Национальные соревнования</p>
                <div class="text-2xl font-bold text-yellow-600 mb-2">13</div>
                <div class="text-sm text-gray-500">Турниров</div>
            </div>

            <!-- Двухдивизионные страны -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center card-hover transition-all duration-300 cursor-pointer">
                <div class="w-16 h-16 mx-auto mb-4 bg-purple-100 rounded-full flex items-center justify-center">
                    <div class="w-8 h-8 text-purple-600">
                        <i class="ri-stack-line ri-lg"></i>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Двухдивизионные страны</h3>
                <p class="text-gray-600 mb-4">Страны с несколькими дивизионами</p>
                <div class="text-2xl font-bold text-purple-600 mb-2">1</div>
                <div class="text-sm text-gray-500">Страна</div>
            </div>
        </div>
    </div>
</section>

@include('site.v1.modules.how-to-join.how-to-join')

@endsection
