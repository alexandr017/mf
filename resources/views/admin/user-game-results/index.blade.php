@extends('admin.layouts.app')
@section('title', 'Результаты игр')
@section('h1', 'Результаты игр')

@section('content')

    <!-- Фильтры -->
    <div class="panel panel-default">
        <div class="panel-heading">Фильтры</div>
        <div class="panel-body">
            <form id="filters-form" class="form-inline">
                <div class="form-group">
                    <label for="user_id">Пользователь:</label>
                    <select name="user_id" id="user_id" class="form-control" style="width: 250px;">
                        <option value="">Все пользователи</option>
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
                    <label for="game_id">Игра:</label>
                    <select name="game_id" id="game_id" class="form-control select2" style="width: 200px;">
                        <option value="">Все игры</option>
                        @foreach($games as $game)
                            <option value="{{$game->id}}" @if(request('game_id') == $game->id) selected @endif>
                                {{$game->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" style="margin-left: 15px;">
                    <label for="win">Результат:</label>
                    <select name="win" id="win" class="form-control select2" style="width: 150px;">
                        <option value="">Все</option>
                        <option value="1" @if(request('win') == '1') selected @endif>Победы</option>
                        <option value="0" @if(request('win') == '0') selected @endif>Поражения</option>
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
                    <button type="button" id="apply-filters" class="btn btn-primary">Применить</button>
                    <button type="button" id="reset-filters" class="btn btn-default">Сбросить</button>
                </div>
            </form>
        </div>
    </div>

    <br>

    <table id="user-game-results-table" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>id</th>
            <th>Пользователь</th>
            <th>Игра</th>
            <th>Счет</th>
            <th>Баллы рейтинга</th>
            <th>Результат</th>
            <th>Дата игры</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
@endsection

@section('after-scripts')
<script>
$(document).ready(function(){
    // Инициализация Select2 для обычных селектов
    $('#game_id, #win').select2({
        theme: 'default',
        width: '100%'
    });

    // Инициализация Select2 для поиска пользователей (AJAX)
    var userSelectConfig = {
        theme: 'default',
        width: '100%',
        placeholder: 'Поиск пользователя...',
        allowClear: true,
        ajax: {
            url: '{{ route("admin.user-game-results.search-users") }}',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, // search term
                    page: params.page
                };
            },
            processResults: function (data) {
                return {
                    results: data.results
                };
            },
            cache: true
        },
        minimumInputLength: 2
    };

    // Если пользователь уже выбран, добавляем его в опции
    @if(request('user_id'))
        @php
            $selectedUser = \App\Models\User::find(request('user_id'));
        @endphp
        @if($selectedUser)
            userSelectConfig.data = [{
                id: {{$selectedUser->id}},
                text: '{{$selectedUser->name}} ({{$selectedUser->email}})'
            }];
        @endif
    @endif

    $('#user_id').select2(userSelectConfig);

    // Инициализация DataTables с серверной обработкой
    var table = $('#user-game-results-table').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "{{ route('admin.user-game-results.data') }}",
            "type": "GET",
            "data": function (d) {
                // Добавляем фильтры к запросу
                d.user_id = $('#user_id').val();
                d.game_id = $('#game_id').val();
                d.win = $('#win').val();
                d.date_from = $('#date_from').val();
                d.date_to = $('#date_to').val();
            }
        },
        "columns": [
            { "data": "id", "name": "id" },
            { "data": "user_name", "name": "user_name" },
            { "data": "game_name", "name": "game_name" },
            { "data": "score", "name": "score" },
            { "data": "rating_points_earned", "name": "rating_points_earned" },
            { 
                "data": "win", 
                "name": "win",
                "render": function(data, type, row) {
                    if (data) {
                        return '<span class="badge badge-success">Победа</span>';
                    } else {
                        return '<span class="badge badge-danger">Поражение</span>';
                    }
                }
            },
            { "data": "played_at", "name": "played_at" }
        ],
        "order": [[6, "desc"]], // Сортировка по дате по умолчанию
        "pageLength": 50,
        "language": {"url": "/admin-assets/dataTables/datatables.json"},
        "searching": true,
        "lengthChange": true,
        "paging": true,
        "info": true
    });

    // Применение фильтров
    $('#apply-filters').on('click', function() {
        table.ajax.reload();
    });

    // Сброс фильтров
    $('#reset-filters').on('click', function() {
        $('#user_id').val(null).trigger('change');
        $('#game_id').val(null).trigger('change');
        $('#win').val(null).trigger('change');
        $('#date_from').val('');
        $('#date_to').val('');
        table.ajax.reload();
    });

    // Автоматическое применение фильтров при изменении
    $('#game_id, #win, #date_from, #date_to').on('change', function() {
        table.ajax.reload();
    });
});
</script>
@endsection

