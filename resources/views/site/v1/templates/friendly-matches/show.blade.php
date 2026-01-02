@extends('site.v1.layouts.default')

@section('content')
<!-- Page Header -->
<section class="bg-gray-900 py-16 relative overflow-hidden">
    <div class="absolute inset-0">
        <img src="/v1/images/tournaments-banner.jpg" alt="Match Background" class="w-full h-full object-cover opacity-30">
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="heading-font text-5xl md:text-7xl text-white mb-6">Товарищеский матч</h1>
        <p class="text-xl text-gray-200 mb-8 max-w-3xl mx-auto">
            {{ $match->homeTeam->name ?? 'Team 1' }} vs {{ $match->awayTeam->name ?? 'Team 2' }}
        </p>
    </div>
</section>

<!-- Match Info -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
            <div class="flex flex-col md:flex-row justify-between items-center mb-8">
                <div class="flex flex-col items-center mb-4 md:mb-0">
                    <div class="w-24 h-24 bg-gray-200 rounded-full mb-4 flex items-center justify-center overflow-hidden">
                        @if($match->homeTeam->logo)
                            <img src="{{ $match->homeTeam->logo }}" alt="{{ $match->homeTeam->name }}" class="object-cover w-full h-full">
                        @else
                            <img src="/v1/images/demo/team-logo.jpg" alt="{{ $match->homeTeam->name }}" class="object-cover w-full h-full">
                        @endif
                    </div>
                    <h2 class="heading-font text-2xl">{{ $match->homeTeam->name }}</h2>
                </div>
                <div class="flex flex-col items-center mb-4 md:mb-0">
                    <div class="bg-gray-100 px-8 py-4 rounded-lg mb-2">
                        <span class="text-4xl font-bold">{{ $match->score_1 ?? 0 }} - {{ $match->score_2 ?? 0 }}</span>
                    </div>
                    <p class="text-sm text-gray-500">
                        {{ $match->date ? $match->date->format('d.m.Y H:i') : '' }}
                    </p>
                    <p class="text-sm text-gray-500 mt-1">
                        {{ $match->homeTeam->stadium ?? 'Stadium' }}
                    </p>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-24 h-24 bg-gray-200 rounded-full mb-4 flex items-center justify-center overflow-hidden">
                        @if($match->awayTeam->logo)
                            <img src="{{ $match->awayTeam->logo }}" alt="{{ $match->awayTeam->name }}" class="object-cover w-full h-full">
                        @else
                            <img src="/v1/images/demo/team-logo.jpg" alt="{{ $match->awayTeam->name }}" class="object-cover w-full h-full">
                        @endif
                    </div>
                    <h2 class="heading-font text-2xl">{{ $match->awayTeam->name }}</h2>
                </div>
            </div>
        </div>

        <!-- Goals and Assists -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <!-- Goals -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="heading-font text-xl text-gray-900 mb-4">Голы</h3>
                @if(count($scorers) > 0)
                    <div class="space-y-3">
                        @foreach($scorers as $scorerData)
                            <div class="flex items-center justify-between border-b pb-2">
                                <div class="flex items-center">
                                    <span class="font-medium">{{ $scorerData['user']->name ?? 'N/A' }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    @foreach($scorerData['goals'] as $minute)
                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded">
                                            {{ $minute }}'
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">Нет данных о голах</p>
                @endif
            </div>

            <!-- Assists -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="heading-font text-xl text-gray-900 mb-4">Голевые передачи</h3>
                @if(count($assists) > 0)
                    <div class="space-y-3">
                        @foreach($assists as $assistData)
                            <div class="flex items-center justify-between border-b pb-2">
                                <div class="flex items-center">
                                    <span class="font-medium">{{ $assistData['user']->name ?? 'N/A' }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    @foreach($assistData['assists'] as $minute)
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded">
                                            {{ $minute }}'
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">Нет данных о передачах</p>
                @endif
            </div>
        </div>

        <!-- Squad -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Team 1 Squad -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="heading-font text-xl text-gray-900 mb-4">{{ $match->homeTeam->name }}</h3>
                @if(count($team1Players) > 0)
                    <div class="space-y-2">
                        @foreach($team1Players as $player)
                            <div class="flex items-center justify-between border-b pb-2">
                                <span class="font-medium">{{ $player['user']->name ?? 'N/A' }}</span>
                                <span class="text-sm text-gray-500">
                                    {{ $player['start_minute'] }}' - {{ $player['end_minute'] }}'
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">Нет данных о составе</p>
                @endif
            </div>

            <!-- Team 2 Squad -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="heading-font text-xl text-gray-900 mb-4">{{ $match->awayTeam->name }}</h3>
                @if(count($team2Players) > 0)
                    <div class="space-y-2">
                        @foreach($team2Players as $player)
                            <div class="flex items-center justify-between border-b pb-2">
                                <span class="font-medium">{{ $player['user']->name ?? 'N/A' }}</span>
                                <span class="text-sm text-gray-500">
                                    {{ $player['start_minute'] }}' - {{ $player['end_minute'] }}'
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">Нет данных о составе</p>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection

