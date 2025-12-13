<h1>{{ $tournament->name }}</h1>

<h2>Сезоны</h2>
<ul>
    @foreach ($seasons as $s)
        <li>
            <a href="/tournaments/{{$tournament->id}}/{{$s->id}}">
                {{ $s->year_start }} / {{ $s->year_finish }}
            </a>
        </li>
    @endforeach
</ul>
