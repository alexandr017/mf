@php
    // Определяем команды
    $homeTeam = $match->homeTeam ?? $match->team_1 ?? null;
    $awayTeam = $match->awayTeam ?? $match->team_2 ?? null;
    
    // Если передан объект команды, используем его, иначе ищем по ID
    if (is_numeric($homeTeam)) {
        $homeTeam = \App\Models\Teams\Team::find($homeTeam);
    }
    if (is_numeric($awayTeam)) {
        $awayTeam = \App\Models\Teams\Team::find($awayTeam);
    }
    
    // Стадион берется от команды-хозяев
    $stadium = $homeTeam->stadium ?? 'Stadium';
    
    // Дата и время
    $matchDate = $match->date ?? null;
    if ($matchDate && !($matchDate instanceof \Carbon\Carbon)) {
        $matchDate = \Carbon\Carbon::parse($matchDate);
    }
    
    // Счет
    $score1 = $match->score_1 ?? null;
    $score2 = $match->score_2 ?? null;
    $isPlayed = isset($match->status) && $match->status === 'played';
    
    // Логотипы команд
    $homeLogo = $homeTeam->logo ?? '/v1/images/demo/team-logo.jpg';
    $awayLogo = $awayTeam->logo ?? '/v1/images/demo/team-logo.jpg';
    
    // Имена команд
    $homeName = $homeTeam->name ?? 'Team 1';
    $awayName = $awayTeam->name ?? 'Team 2';
    
    // Определяем URL для клика
    $matchUrl = null;
    if (isset($match->id)) {
        // Проверяем, это товарищеский матч или турнирный
        if (isset($match->stage_id) || isset($match->group_id)) {
            // Турнирный матч - пока не реализовано, можно добавить позже
            // $matchUrl = "/tournaments/matches/{$match->id}";
        } else {
            // Товарищеский матч
            $matchUrl = "/friendly-matches/{$match->id}";
        }
    }
    
    // Если матч сыгран, всегда показываем ссылку
    if ($isPlayed && $matchUrl) {
        $matchUrl = $matchUrl;
    } elseif (!$isPlayed && $matchUrl) {
        // Для запланированных матчей тоже можно показать ссылку
        $matchUrl = $matchUrl;
    }
    
    // Если передан флаг noLink, не создаем ссылку (уже обернуто)
    $noLink = $noLink ?? false;
    if ($noLink) {
        $matchUrl = null;
    }
@endphp

@if($matchUrl)
    <a href="{{ $matchUrl }}" class="block">
@endif
<div class="bg-white rounded-lg shadow-lg p-6 min-w-[300px] border-2 border-gray-200 card-hover transition-all duration-300{{ $matchUrl ? ' cursor-pointer' : '' }}">
    <div class="flex justify-between items-center mb-4">
        <div class="flex flex-col items-center">
            <div class="w-16 h-16 bg-gray-200 rounded-full mb-2 flex items-center justify-center overflow-hidden">
                <img src="{{ $homeLogo }}" alt="{{ $homeName }}" class="object-cover w-full h-full object-top">
            </div>
            <span class="font-medium text-sm text-center">{{ $homeName }}</span>
        </div>
        <div class="flex flex-col items-center">
            <div class="bg-gray-100 px-2 py-2 rounded-lg mb-1">
                @if($isPlayed && $score1 !== null && $score2 !== null)
                    <span class="text-2xl font-bold">{{ $score1 }} - {{ $score2 }}</span>
                @else
                    <span class="text-xl font-bold text-gray-500">VS</span>
                @endif
            </div>
            @if($matchDate)
                <span class="text-xs text-gray-500">{{ $matchDate->format('d.m.Y') }}</span>
                <span class="text-xs text-gray-500">{{ $matchDate->format('H:i') }}</span>
            @else
                <span class="text-xs text-gray-500">-</span>
            @endif
        </div>
        <div class="flex flex-col items-center">
            <div class="w-16 h-16 bg-gray-200 rounded-full mb-2 flex items-center justify-center overflow-hidden">
                <img src="{{ $awayLogo }}" alt="{{ $awayName }}" class="object-cover w-full h-full object-top">
            </div>
            <span class="font-medium text-sm text-center">{{ $awayName }}</span>
        </div>
    </div>
    <div class="text-center">
        <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded">{{ $stadium }}</span>
    </div>
</div>
@if($matchUrl)
    </a>
@endif

