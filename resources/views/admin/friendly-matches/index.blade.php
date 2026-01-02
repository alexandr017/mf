@extends('admin.layouts.app')
@section('title', 'Список товарищеских матчей')
@section('h1', 'Список товарищеских матчей')

@section('content')

    <a href="{{route('admin.friendly-matches.create')}}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Добавить матч</a>

    <br>
    <br>

    <table id="rowtbl" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>id</th>
            <th>Команда 1</th>
            <th>Команда 2</th>
            <th>Дата</th>
            <th>Счет</th>
            <th>Статус</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($matches as $match)
            <tr>
                <td>{{ $match->id }}</td>
                <td>{{ $match->homeTeam->name ?? 'N/A' }}</td>
                <td>{{ $match->awayTeam->name ?? 'N/A' }}</td>
                <td>{{ $match->date ? $match->date->format('d.m.Y H:i') : '-' }}</td>
                <td>
                    @if($match->score_1 !== null && $match->score_2 !== null)
                        {{ $match->score_1 }} - {{ $match->score_2 }}
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>
                <td>
                    @if($match->status === 'played')
                        <span class="badge badge-success">Сыгран</span>
                    @elseif($match->status === 'scheduled')
                        <span class="badge badge-info">Запланирован</span>
                    @else
                        <span class="badge badge-warning">Отменен</span>
                    @endif
                </td>
                <td>
                    @if($match->status === 'played')
                        <a href="/friendly-matches/{{ $match->id }}" target="_blank" class="btn btn-info btn-xs" title="Просмотр на сайте"><i class="fa fa-eye"></i></a>
                    @endif
                    <a href="{{route('admin.friendly-matches.edit', $match->id) }}" class="btn btn-primary btn-xs" title="Редактировать"><i class="fa fa-edit"></i></a>
                    <form action="{{ route('admin.friendly-matches.destroy', $match->id) }}" method="post" class="inline">
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

