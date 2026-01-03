@php
    $highlightPositions = $highlightPositions ?? false;
    $totalTeams = count($teams);
@endphp
<table class="w-full bg-white divide-y divide-gray-200" style="min-width: 800px; width: 100%;">
    <thead class="bg-gray-100">
    <tr>
        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider sticky left-0 bg-gray-100 z-10">Позиция</th>
        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider sticky left-[60px] sm:left-[73px] bg-gray-100 z-10">Команда</th>
        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Страна</th>
        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Город</th>
        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Игр</th>
        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Побед</th>
        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ничьих</th>
        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Поражений</th>
        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">РМ</th>
        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Очки</th>
    </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
    @foreach($teams as $team)
        @php
            $rowClass = 'hover:bg-gray-50';
            if ($highlightPositions) {
                // Зеленый для топ-4 (позиции 1-4)
                if ($team->position <= 4) {
                    $rowClass = 'bg-green-50 hover:bg-green-100';
                }
                // Красный для последних 4 (если команд больше 8)
                elseif ($totalTeams > 8 && $team->position > ($totalTeams - 4)) {
                    $rowClass = 'bg-red-50 hover:bg-red-100';
                }
            }
        @endphp
    <tr class="{{ $rowClass }}">
        <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 sticky left-0 z-10 {{ $highlightPositions && $team->position <= 4 ? 'bg-green-50' : ($highlightPositions && $totalTeams > 8 && $team->position > ($totalTeams - 4) ? 'bg-red-50' : 'bg-white') }}">{{$team->position}}</td>
        <td class="px-3 sm:px-6 py-4 whitespace-nowrap sticky left-[60px] sm:left-[73px] z-10 {{ $highlightPositions && $team->position <= 4 ? 'bg-green-50' : ($highlightPositions && $totalTeams > 8 && $team->position > ($totalTeams - 4) ? 'bg-red-50' : 'bg-white') }}">
            <div class="flex items-center">
                <div class="flex-shrink-0 h-8 w-8 sm:h-10 sm:w-10 rounded-full overflow-hidden">
                    <a href="/teams/{{$team->alias}}">
                        <img src="{{$team->logo}}" alt="{{$team->name}}" class="h-full w-full object-cover object-top">
                    </a>
                </div>
                <div class="ml-2 sm:ml-4">
                    <div class="text-xs sm:text-sm font-medium text-gray-900">
                        <a href="/teams/{{$team->alias}}" class="hover:text-primary">{{$team->name}}</a>
                    </div>
                </div>
            </div>
        </td>
        <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
            @if($team->country_name)
                <span class="inline-flex items-center px-2 py-0.5 sm:px-2.5 rounded-full text-xs font-medium" style="background-color: {{ $team->country_color ?? '#7FFF00' }}; color: {{ ($team->country_color ?? '#7FFF00') == '#7FFF00' ? '#1f2937' : 'white' }};">
                    {{ $team->country_name }}
                </span>
            @else
                <span class="inline-flex items-center px-2 py-0.5 sm:px-2.5 rounded-full text-xs font-medium bg-gray-200 text-gray-700">
                    СНГ
                </span>
            @endif
        </td>
        <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-xs sm:text-sm text-gray-500">
            {{ $team->city_name ?? '-' }}
        </td>
        <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-xs sm:text-sm text-gray-500">{{$team->games}}</td>
        <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-xs sm:text-sm text-gray-500">{{$team->wins}}</td>
        <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-xs sm:text-sm text-gray-500">{{$team->draws}}</td>
        <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-xs sm:text-sm text-gray-500">{{$team->losses}}</td>
        <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-xs sm:text-sm text-gray-500">
            @if($team->goal_difference > 0)
                +{{$team->goal_difference}}
            @else
                {{$team->goal_difference}}
            @endif
        </td>
        <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-xs sm:text-sm font-bold text-gray-900">{{$team->points}}</td>
    </tr>
    @endforeach
    </tbody>
</table>
