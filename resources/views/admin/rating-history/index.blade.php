@extends('admin.layouts.app')
@section('title', 'История рейтинга')
@section('h1', 'История рейтинга')

@section('content')

    <!-- Фильтры -->
    <div class="panel panel-default">
        <div class="panel-heading">Фильтры</div>
        <div class="panel-body">
            <form method="GET" action="{{ route('admin.rating-history.index') }}" class="form-inline">
                <div class="form-group">
                    <label for="user_id">Пользователь:</label>
                    <select name="user_id" id="user_id" class="form-control select2-ajax" style="width: 200px;">
                        @if(request('user_id'))
                            @php
                                $selectedUser = \App\Models\User::find(request('user_id'));
                            @endphp
                            @if($selectedUser)
                                <option value="{{$selectedUser->id}}" selected>{{$selectedUser->name}} ({{$selectedUser->email}})</option>
                            @endif
                        @endif
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
                    <a href="{{ route('admin.rating-history.index') }}" class="btn btn-default">Сбросить</a>
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
            <th>Описание</th>
            <th>Дата</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($ratingHistory as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->user->name ?? '-' }}</td>
                <td>
                    <span class="badge badge-{{ $item->type === 'earn' ? 'success' : 'danger' }}">
                        {{ $item->type === 'earn' ? '+' : '-' }}{{ $item->points }}
                    </span>
                </td>
                <td>
                    @if($item->type === 'earn')
                        <span class="badge badge-success">Начисление</span>
                    @else
                        <span class="badge badge-danger">Списание</span>
                    @endif
                </td>
                <td>{{ $item->game->name ?? '-' }}</td>
                <td>{{ Str::limit($item->description ?? '-', 50) }}</td>
                <td>{{ $item->created_at->format('d.m.Y H:i') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@section('after-scripts')
<script>
$(document).ready(function(){
    // Инициализация Select2 для поиска пользователей (AJAX)
    var userSelectConfig = {
        theme: 'default',
        width: '100%',
        placeholder: 'Поиск пользователя...',
        allowClear: true,
        ajax: {
            url: '{{ route("admin.rating-history.search-users") }}',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term,
                    page: params.page || 1
                };
            },
            processResults: function (data) {
                return {
                    results: data.results
                };
            },
            cache: true
        },
        minimumInputLength: 1
    };

    $('#user_id').select2(userSelectConfig);
});
</script>
@endsection

