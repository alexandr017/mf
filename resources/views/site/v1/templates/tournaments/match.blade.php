<h1>{{ $match->homeTeam->name }} — {{ $match->awayTeam->name }}</h1>

<p>Счёт: {{ $match->score_1 }} : {{ $match->score_2 }}</p>

@if($match->stage)
    <p>Стадия: {{ $match->stage->name }}</p>
@endif

@if($match->group)
    <p>Группа: {{ $match->group->name }}</p>
@endif
