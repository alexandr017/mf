@extends('admin.layouts.app')
@section('title', 'Составы команд')
@section('h1', 'Составы команд')

@section('content')

    <a href="{{route('admin.team-players.create')}}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Добавить игрока в команду</a>

    <br>
    <br>

    <!-- Фильтры -->
    <div class="panel panel-default">
        <div class="panel-heading">Фильтры</div>
        <div class="panel-body">
            <form method="GET" action="{{ route('admin.team-players.index') }}" class="form-inline">
                <div class="form-group">
                    <label for="team_id">Команда:</label>
                    <select name="team_id" id="team_id" class="form-control" style="width: 200px;">
                        <option value="">Все команды</option>
                        @foreach($teams as $team)
                            <option value="{{$team->id}}" @if(request('team_id') == $team->id) selected @endif>
                                {{$team->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" style="margin-left: 15px;">
                    <label for="user_id">Игрок:</label>
                    <select name="user_id" id="user_id" class="form-control" style="width: 200px;">
                        <option value="">Все игроки</option>
                        @foreach($users as $user)
                            <option value="{{$user->id}}" @if(request('user_id') == $user->id) selected @endif>
                                {{$user->name}}
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
                    <button type="submit" class="btn btn-primary">Применить</button>
                    <a href="{{ route('admin.team-players.index') }}" class="btn btn-default">Сбросить</a>
                </div>
            </form>
        </div>
    </div>

    <br>

    <table id="rowtbl" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>id</th>
            <th>Команда</th>
            <th>Игрок</th>
            <th>Сезон</th>
            <th>Добавлен</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($teamPlayers as $teamPlayer)
            <tr>
                <td>{{ $teamPlayer->id }}</td>
                <td>{{ $teamPlayer->team->name ?? '-' }}</td>
                <td>{{ $teamPlayer->user->name ?? '-' }}</td>
                <td>{{ $teamPlayer->season->year_start ?? '-' }}/{{ $teamPlayer->season->year_finish ?? '-' }}</td>
                <td>{{ $teamPlayer->created_at->format('d.m.Y') }}</td>
                <td>
                    <a href="{{route('admin.team-players.edit', $teamPlayer->id) }}" class="btn btn-primary btn-xs" title="Редактировать"><i class="fa fa-edit"></i></a>
                    <form action="{{ route('admin.team-players.destroy',$teamPlayer->id) }}" method="post" class="inline">
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




