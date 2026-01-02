@extends('admin.layouts.app')
@section('title', 'Список матчей для прогнозов')
@section('h1', 'Список матчей для прогнозов')

@section('content')

    <a href="{{route('admin.match-predictions.create')}}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Добавить матч</a>

    <br>
    <br>

    <table id="rowtbl" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>id</th>
            <th>Команда 1</th>
            <th>Команда 2</th>
            <th>Дата матча</th>
            <th>Дедлайн</th>
            <th>Счет</th>
            <th>Статус</th>
            <th>Прогнозов</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($matches as $match)
            <tr>
                <td>{{ $match->id }}</td>
                <td>{{ $match->team_1_name }}</td>
                <td>{{ $match->team_2_name }}</td>
                <td>{{ $match->match_date ? $match->match_date->format('d.m.Y H:i') : '-' }}</td>
                <td>{{ $match->prediction_deadline ? $match->prediction_deadline->format('d.m.Y H:i') : '-' }}</td>
                <td>
                    @if($match->score_1 !== null && $match->score_2 !== null)
                        {{ $match->score_1 }} - {{ $match->score_2 }}
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>
                <td>
                    @if($match->status === 'finished')
                        <span class="badge badge-success">Завершен</span>
                    @elseif($match->status === 'scheduled')
                        <span class="badge badge-info">Запланирован</span>
                    @else
                        <span class="badge badge-warning">Отменен</span>
                    @endif
                </td>
                <td>{{ $match->userPredictions()->count() }}</td>
                <td>
                    <a href="{{route('admin.match-predictions.edit', $match->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                    <form action="{{route('admin.match-predictions.destroy', $match->id)}}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Вы уверены?')"><i class="fa fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection

