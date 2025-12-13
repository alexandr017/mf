<h1>{{ $tournament->name }} — {{ $season->year_start }}/{{ $season->year_finish }}</h1>

@foreach ($season->stages as $stage)
    <h2>{{ $stage->name }}</h2>

    @foreach ($stage->groups as $group)
        <h3>{{ $group->name }}</h3>
    @endforeach

    <ul>
        @foreach ($stage->matches as $m)
            <li>
{{--                <a href="{{ route('match.show', $m->id) }}">--}}
                    {{ $m->homeTeam->name }} - {{ $m->awayTeam->name }}
                    ({{ $m->score_1 }}:{{ $m->score_2 }})
{{--                </a>--}}
            </li>
        @endforeach
    </ul>

@endforeach
