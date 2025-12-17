@extends('admin.layouts.app')
@section('title', 'Транзакции')
@section('h1', 'Транзакции')

@section('content')

    <!-- Фильтры -->
    <div class="panel panel-default">
        <div class="panel-heading">Фильтры</div>
        <div class="panel-body">
            <form method="GET" action="{{ route('admin.transactions.index') }}" class="form-inline">
                <div class="form-group">
                    <label for="user_id">Пользователь:</label>
                    <select name="user_id" id="user_id" class="form-control" style="width: 200px;">
                        <option value="">Все пользователи</option>
                        @foreach($users as $user)
                            <option value="{{$user->id}}" @if(request('user_id') == $user->id) selected @endif>
                                {{$user->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" style="margin-left: 15px;">
                    <label for="type">Тип:</label>
                    <select name="type" id="type" class="form-control" style="width: 150px;">
                        <option value="">Все типы</option>
                        <option value="earn" @if(request('type') == 'earn') selected @endif>Начисление</option>
                        <option value="spend" @if(request('type') == 'spend') selected @endif>Списание</option>
                    </select>
                </div>
                <div class="form-group" style="margin-left: 15px;">
                    <label for="game_id">Игра:</label>
                    <select name="game_id" id="game_id" class="form-control" style="width: 200px;">
                        <option value="">Все игры</option>
                        @foreach($games as $game)
                            <option value="{{$game->id}}" @if(request('game_id') == $game->id) selected @endif>
                                {{$game->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" style="margin-left: 15px;">
                    <label for="date_from">Дата с:</label>
                    <input type="date" name="date_from" id="date_from" class="form-control" value="{{request('date_from')}}">
                </div>
                <div class="form-group" style="margin-left: 15px;">
                    <label for="date_to">Дата по:</label>
                    <input type="date" name="date_to" id="date_to" class="form-control" value="{{request('date_to')}}">
                </div>
                <div class="form-group" style="margin-left: 15px;">
                    <button type="submit" class="btn btn-primary">Применить</button>
                    <a href="{{ route('admin.transactions.index') }}" class="btn btn-default">Сбросить</a>
                </div>
            </form>
        </div>
    </div>

    <br>

    <table id="rowtbl" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>id</th>
            <th>Пользователь</th>
            <th>Баллы</th>
            <th>Тип</th>
            <th>Игра</th>
            <th>Матч</th>
            <th>Описание</th>
            <th>Дата</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($transactions as $transaction)
            <tr>
                <td>{{ $transaction->id }}</td>
                <td>{{ $transaction->user->name ?? '-' }}</td>
                <td>
                    <span class="badge badge-{{ $transaction->type === 'earn' ? 'success' : 'danger' }}">
                        {{ $transaction->type === 'earn' ? '+' : '-' }}{{ $transaction->points }}
                    </span>
                </td>
                <td>
                    @if($transaction->type === 'earn')
                        <span class="badge badge-success">Начисление</span>
                    @else
                        <span class="badge badge-danger">Списание</span>
                    @endif
                </td>
                <td>{{ $transaction->game->name ?? '-' }}</td>
                <td>
                    @if($transaction->match)
                        Матч #{{ $transaction->match->id }}
                    @else
                        -
                    @endif
                </td>
                <td>{{ Str::limit($transaction->description ?? '-', 50) }}</td>
                <td>{{ $transaction->created_at->format('d.m.Y H:i') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection


