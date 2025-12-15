@extends('admin.layouts.app')
@section('title', 'Логи действий')
@section('h1', 'Логи действий')

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
                    <label for="action">Действие:</label>
                    <select name="action" id="action" class="form-control select2" style="width: 150px;">
                        <option value="">Все действия</option>
                        @foreach($actions as $action)
                            <option value="{{$action}}" @if(request('action') == $action) selected @endif>{{$action}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" style="margin-left: 15px;">
                    <label for="model_type">Тип модели:</label>
                    <select name="model_type" id="model_type" class="form-control select2" style="width: 200px;">
                        <option value="">Все типы</option>
                        @foreach($modelTypes as $modelType)
                            <option value="{{$modelType}}" @if(request('model_type') == $modelType) selected @endif>{{ class_basename($modelType) }}</option>
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
                    <button type="button" id="apply-filters" class="btn btn-primary">Применить</button>
                    <button type="button" id="reset-filters" class="btn btn-default">Сбросить</button>
                </div>
            </form>
        </div>
    </div>

    <br>

    <table id="activity-logs-table" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>id</th>
            <th>Пользователь</th>
            <th>Действие</th>
            <th>Модель</th>
            <th>Описание</th>
            <th>IP адрес</th>
            <th>Дата</th>
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
    $('#action, #model_type').select2({
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
            url: '{{ route("admin.activity-logs.search-users") }}',
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
    var table = $('#activity-logs-table').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "{{ route('admin.activity-logs.data') }}",
            "type": "GET",
            "data": function (d) {
                // Добавляем фильтры к запросу
                d.user_id = $('#user_id').val();
                d.action = $('#action').val();
                d.model_type = $('#model_type').val();
                d.date_from = $('#date_from').val();
                d.date_to = $('#date_to').val();
            }
        },
        "columns": [
            { "data": "id", "name": "id" },
            { "data": "user_name", "name": "user_name" },
            { "data": "action", "name": "action" },
            { "data": "model_type", "name": "model_type" },
            { "data": "description", "name": "description" },
            { "data": "ip_address", "name": "ip_address" },
            { "data": "created_at", "name": "created_at" }
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
        $('#action').val(null).trigger('change');
        $('#model_type').val(null).trigger('change');
        $('#date_from').val('');
        $('#date_to').val('');
        table.ajax.reload();
    });

    // Автоматическое применение фильтров при изменении
    $('#action, #model_type, #date_from, #date_to').on('change', function() {
        table.ajax.reload();
    });
});
</script>
@endsection
