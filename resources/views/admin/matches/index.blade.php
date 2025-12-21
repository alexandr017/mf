@extends('admin.layouts.app')
@section('title', 'Список матчей')
@section('h1', 'Список матчей')

@section('content')

    <a href="{{route('admin.matches.create')}}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Добавить матч</a>

    <br>
    <br>

    <!-- Фильтры -->
    <div class="panel panel-default">
        <div class="panel-heading">Фильтры</div>
        <div class="panel-body">
            <form method="GET" action="{{ route('admin.matches.index') }}" class="form-inline">
                <div class="form-group">
                    <label for="tournament_id">Турнир:</label>
                    <select name="tournament_id" id="tournament_id" class="form-control" style="width: 200px;">
                        <option value="">Все турниры</option>
                        @foreach($tournaments as $tournament)
                            <option value="{{$tournament->id}}" @if(request('tournament_id') == $tournament->id) selected @endif>
                                {{$tournament->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" style="margin-left: 15px;">
                    <label for="season_id">Сезон:</label>
                    <select name="season_id" id="season_id" class="form-control" style="width: 200px;">
                        <option value="">Все сезоны</option>
                        @foreach($seasons as $season)
                            <option value="{{$season->id}}" @if(request('season_id') == $season->id) selected @endif>
                                {{$season->year_start}}/{{$season->year_finish}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" style="margin-left: 15px;">
                    <label for="stage_id">Стадия:</label>
                    <select name="stage_id" id="stage_id" class="form-control" style="width: 200px;">
                        <option value="">Все стадии</option>
                        @foreach($stages as $stage)
                            <option value="{{$stage->id}}" @if(request('stage_id') == $stage->id) selected @endif>
                                {{$stage->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" style="margin-left: 15px;">
                    <button type="submit" class="btn btn-primary">Применить</button>
                    <a href="{{ route('admin.matches.index') }}" class="btn btn-default">Сбросить</a>
                </div>
            </form>
        </div>
    </div>

    <br>

    <table id="rowtbl" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>id</th>
            <th>Турнир / Сезон</th>
            <th>Стадия</th>
            <th>Группа</th>
            <th>Команда 1</th>
            <th>Команда 2</th>
            <th>Счет</th>
            <th>Дата</th>
            <th>Статус</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($matches as $match)
            <tr>
                <td>{{ $match->id }}</td>
                <td>
                    @if($match->stage && $match->stage->season && $match->stage->season->tournament)
                        {{ $match->stage->season->tournament->name }}<br>
                        <small>{{ $match->stage->season->year_start }}/{{ $match->stage->season->year_finish }}</small>
                    @else
                        -
                    @endif
                </td>
                <td>{{ $match->stage->name ?? '-' }}</td>
                <td>{{ $match->group->name ?? '-' }}</td>
                <td>{{ $match->homeTeam->name ?? 'TBD' }}</td>
                <td>{{ $match->awayTeam->name ?? 'TBD' }}</td>
                <td>
                    @if($match->status === 'played')
                        {{ $match->score_1 ?? 0 }}:{{ $match->score_2 ?? 0 }}
                        @if($match->pen_1 !== null && $match->pen_2 !== null)
                            <br><small>(пен. {{ $match->pen_1 }}:{{ $match->pen_2 }})</small>
                        @endif
                    @else
                        -
                    @endif
                </td>
                <td>{{ $match->date ? $match->date->format('d.m.Y H:i') : '-' }}</td>
                <td>
                    @if($match->status === 'scheduled')
                        <span class="badge badge-info">Запланирован</span>
                    @elseif($match->status === 'played')
                        <span class="badge badge-success">Сыгран</span>
                    @elseif($match->status === 'cancelled')
                        <span class="badge badge-danger">Отменен</span>
                    @endif
                </td>
                <td>
                    @if(in_array($match->id, $liveMatchIds ?? []))
                        <a href="{{ route('live-matches.show', $match->id) }}" target="_blank" class="btn btn-success btn-xs" title="Смотреть матч">
                            <i class="fa fa-play"></i> Смотреть
                        </a>
                        <form action="{{ route('admin.matches.stop-live', $match->id) }}" method="post" class="inline">
                            {{ method_field('POST') }}
                            <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">
                            <button class="btn btn-warning btn-xs" title="Завершить матч" onclick="return confirm('Вы уверены, что хотите принудительно завершить матч?')">
                                <i class="fa fa-stop"></i> Завершить
                            </button>
                        </form>
                    @else
                        @if($match->team_1 && $match->team_2)
                            <form action="{{ route('admin.matches.start-live', $match->id) }}" method="post" class="inline">
                                {{ method_field('POST') }}
                                <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">
                                <button class="btn btn-success btn-xs" title="Запустить матч">
                                    <i class="fa fa-play"></i> Запустить
                                </button>
                            </form>
                        @endif
                    @endif
                    <a href="{{route('admin.matches.edit', $match->id) }}" class="btn btn-primary btn-xs" title="Редактировать"><i class="fa fa-edit"></i></a>
                    <form action="{{ route('admin.matches.destroy',$match->id) }}" method="post" class="inline">
                        {{ method_field('DELETE') }}
                        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">
                        <button class="btn btn-danger btn-xs rest-destroy" title="Удалить"><i class="fa fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection



