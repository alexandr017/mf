@extends('admin.layouts.app')
@section('title', 'Список игр')
@section('h1', 'Список игр')

@section('content')

    <a href="{{route('admin.games.create')}}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Добавить игру</a>

    <br>
    <br>

    <table id="rowtbl" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>id</th>
            <th>Название</th>
            <th>Баллы рейтинга</th>
            <th>Порядок</th>
            <th>Статус</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($games as $game)
            <tr>
                <td>{{ $game->id }}</td>
                <td>{{ $game->name }}</td>
                <td>{{ $game->rating_points ?? 0 }}</td>
                <td>{{ $game->order ?? 0 }}</td>
                <td>@if($game->status) <span class="badge badge-success">Активна</span> @else <span class="badge badge-warning">Неактивна</span>@endif</td>
                <td>
                    <a href="{{route('admin.games.edit', $game->id) }}" class="btn btn-primary btn-xs" title="Редактировать"><i class="fa fa-edit"></i></a>
                    <form action="{{ route('admin.games.destroy',$game->id) }}" method="post" class="inline">
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




