@extends('admin.layouts.app')
@section('title', 'Список команд')
@section('h1', 'Список команд')

@section('content')

    <a href="{{route('admin.teams.create')}}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Добавить команду</a>

    <br>
    <br>

    <table id="rowtbl" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>id</th>
            <th>Название</th>
            <th>Алиас</th>
            <th>Стадион</th>
            <th>Статус</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($teams as $team)
            <tr>
                <td>{{ $team->id }}</td>
                <td>{{ $team->name }}</td>
                <td>{{ $team->alias }}</td>
                <td>{{ $team->stadium }}</td>
                <td>@if($team->status) <span class="badge badge-success">Активна</span> @else <span class="badge badge-warning">Неактивна</span>@endif</td>
                <td>
                    @if($team->alias)
                        <a href="/teams/{{$team->alias}}" target="_blank" class="btn btn-info btn-xs" title="Открыть"><i class="fa fa-eye"></i></a>
                    @endif
                    <a href="{{route('admin.teams.edit', $team->id) }}" class="btn btn-primary btn-xs" title="Редактировать"><i class="fa fa-edit"></i></a>
                    <form action="{{ route('admin.teams.destroy',$team->id) }}" method="post" class="inline">
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

