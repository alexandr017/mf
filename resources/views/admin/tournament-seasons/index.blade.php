@extends('admin.layouts.app')
@section('title', 'Список сезонов')
@section('h1', 'Список сезонов')

@section('content')

    <div class="row">
        <div class="col-md-4">
            <a href="{{route('admin.tournament-seasons.create', ['tournament_id' => $tournamentId])}}" class="btn btn-success btn-xs">
                <i class="fa fa-plus"></i> Добавить сезон
            </a>
        </div>
        <div class="col-md-8">
            <form method="GET" action="{{route('admin.tournament-seasons.index')}}" class="form-inline">
                <div class="form-group">
                    <label for="tournament_id">Фильтр по турниру:</label>
                    <select name="tournament_id" id="tournament_id" class="form-control" onchange="this.form.submit()">
                        <option value="">Все турниры</option>
                        @foreach($tournaments as $tournament)
                            <option value="{{$tournament->id}}" @if($tournamentId == $tournament->id) selected @endif>
                                {{$tournament->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
    </div>

    <br>
    <br>

    <table id="rowtbl" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>id</th>
            <th>Турнир</th>
            <th>Сезон</th>
            <th>Статус</th>
            <th>Стадий</th>
            <th>Матчей</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($seasons as $season)
            <tr>
                <td>{{ $season->id }}</td>
                <td>{{ $season->tournament->name ?? '-' }}</td>
                <td>{{ $season->year_start }}/{{ $season->year_finish }}</td>
                <td>@if($season->status) <span class="badge badge-success">Активен</span> @else <span class="badge badge-warning">Неактивен</span>@endif</td>
                <td>{{ $season->stages->count() }}</td>
                <td>{{ $season->stages->sum(function($stage) { return $stage->matches->count(); }) }}</td>
                <td>
                    <a href="{{route('admin.tournament-seasons.edit', $season->id) }}" class="btn btn-primary btn-xs" title="Редактировать"><i class="fa fa-edit"></i></a>
                    <form action="{{ route('admin.tournament-seasons.destroy',$season->id) }}" method="post" class="inline">
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


