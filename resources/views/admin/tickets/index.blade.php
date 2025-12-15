@extends('admin.layouts.app')
@section('title', 'Тикеты')
@section('h1', 'Тикеты')

@section('content')

    <a href="{{route('admin.tickets.create')}}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Создать тикет</a>

    <br>
    <br>

    <!-- Фильтры -->
    <div class="panel panel-default">
        <div class="panel-heading">Фильтры</div>
        <div class="panel-body">
            <form id="filters-form" class="form-inline">
                <div class="form-group">
                    <label for="status">Статус:</label>
                    <select name="status" id="status" class="form-control select2" style="width: 150px;">
                        <option value="">Все статусы</option>
                        <option value="open" @if(request('status') == 'open') selected @endif>Открыт</option>
                        <option value="in_progress" @if(request('status') == 'in_progress') selected @endif>В работе</option>
                        <option value="closed" @if(request('status') == 'closed') selected @endif>Закрыт</option>
                        <option value="resolved" @if(request('status') == 'resolved') selected @endif>Решен</option>
                    </select>
                </div>
                <div class="form-group" style="margin-left: 15px;">
                    <label for="priority">Приоритет:</label>
                    <select name="priority" id="priority" class="form-control select2" style="width: 150px;">
                        <option value="">Все приоритеты</option>
                        <option value="low" @if(request('priority') == 'low') selected @endif>Низкий</option>
                        <option value="medium" @if(request('priority') == 'medium') selected @endif>Средний</option>
                        <option value="high" @if(request('priority') == 'high') selected @endif>Высокий</option>
                        <option value="urgent" @if(request('priority') == 'urgent') selected @endif>Срочный</option>
                    </select>
                </div>
                <div class="form-group" style="margin-left: 15px;">
                    <label for="created_by_user_id">Создатель:</label>
                    <select name="created_by_user_id" id="created_by_user_id" class="form-control" style="width: 250px;">
                        <option value="">Все</option>
                        @if(request('created_by_user_id'))
                            @php
                                $selectedUser = \App\Models\User::find(request('created_by_user_id'));
                            @endphp
                            @if($selectedUser)
                                <option value="{{$selectedUser->id}}" selected>{{$selectedUser->name}} ({{$selectedUser->email}})</option>
                            @endif
                        @endif
                    </select>
                </div>
                <div class="form-group" style="margin-left: 15px;">
                    <label for="assigned_to_user_id">Назначен:</label>
                    <select name="assigned_to_user_id" id="assigned_to_user_id" class="form-control" style="width: 250px;">
                        <option value="">Все</option>
                        @if(request('assigned_to_user_id'))
                            @php
                                $selectedUser = \App\Models\User::find(request('assigned_to_user_id'));
                            @endphp
                            @if($selectedUser)
                                <option value="{{$selectedUser->id}}" selected>{{$selectedUser->name}} ({{$selectedUser->email}})</option>
                            @endif
                        @endif
                    </select>
                </div>
                <div class="form-group" style="margin-left: 15px;">
                    <button type="button" id="apply-filters" class="btn btn-primary">Применить</button>
                    <button type="button" id="reset-filters" class="btn btn-default">Сбросить</button>
                </div>
            </form>
        </div>
    </div>

    <br>

    <div style="overflow-x: auto; max-width: 100%;">
        <table id="tickets-table" class="table table-striped table-bordered table-hover" style="min-width: 1200px; max-width: 100%;">
            <thead>
            <tr>
                <th style="min-width: 50px; max-width: 80px;">id</th>
                <th style="min-width: 200px; max-width: 300px;">Тема</th>
                <th style="min-width: 180px; max-width: 250px;">Создатель</th>
                <th style="min-width: 180px; max-width: 250px;">Назначен</th>
                <th style="min-width: 100px; max-width: 120px;">Статус</th>
                <th style="min-width: 100px; max-width: 120px;">Приоритет</th>
                <th style="min-width: 80px; max-width: 100px;">Сообщений</th>
                <th style="min-width: 120px; max-width: 150px;">Создан</th>
                <th style="min-width: 120px; max-width: 150px;">Действия</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
@endsection

@section('after-scripts')
<style>
    #tickets-table {
        table-layout: fixed;
        width: 100%;
    }
    #tickets-table th,
    #tickets-table td {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    #tickets-table th:nth-child(2),
    #tickets-table td:nth-child(2) {
        white-space: normal;
        word-wrap: break-word;
    }
    #tickets-table th:nth-child(3),
    #tickets-table td:nth-child(3),
    #tickets-table th:nth-child(4),
    #tickets-table td:nth-child(4) {
        white-space: normal;
        word-wrap: break-word;
    }
</style>
<script>
$(document).ready(function(){
    // Инициализация Select2 для обычных селектов
    $('#status, #priority').select2({
        theme: 'default',
        width: '100%'
    });

    // Инициализация Select2 для поиска пользователей (AJAX) - создатель
    var createdBySelectConfig = {
        theme: 'default',
        width: '100%',
        placeholder: 'Поиск пользователя...',
        allowClear: true,
        ajax: {
            url: '{{ route("admin.tickets.search-users") }}',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term,
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
    @if(request('created_by_user_id'))
        @php
            $selectedUser = \App\Models\User::find(request('created_by_user_id'));
        @endphp
        @if($selectedUser)
            createdBySelectConfig.data = [{
                id: {{$selectedUser->id}},
                text: '{{$selectedUser->name}} ({{$selectedUser->email}})'
            }];
        @endif
    @endif

    $('#created_by_user_id').select2(createdBySelectConfig);

    // Инициализация Select2 для поиска пользователей (AJAX) - назначенный
    var assignedToSelectConfig = {
        theme: 'default',
        width: '100%',
        placeholder: 'Поиск пользователя...',
        allowClear: true,
        ajax: {
            url: '{{ route("admin.tickets.search-users") }}',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term,
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
    @if(request('assigned_to_user_id'))
        @php
            $selectedUser = \App\Models\User::find(request('assigned_to_user_id'));
        @endphp
        @if($selectedUser)
            assignedToSelectConfig.data = [{
                id: {{$selectedUser->id}},
                text: '{{$selectedUser->name}} ({{$selectedUser->email}})'
            }];
        @endif
    @endif

    $('#assigned_to_user_id').select2(assignedToSelectConfig);

    // Инициализация DataTables с серверной обработкой
    var table = $('#tickets-table').DataTable({
        "processing": true,
        "serverSide": true,
        "scrollX": true,
        "autoWidth": false,
        "ajax": {
            "url": "{{ route('admin.tickets.data') }}",
            "type": "GET",
            "data": function (d) {
                // Добавляем фильтры к запросу
                d.status = $('#status').val();
                d.priority = $('#priority').val();
                d.created_by_user_id = $('#created_by_user_id').val();
                d.assigned_to_user_id = $('#assigned_to_user_id').val();
            }
        },
        "columns": [
            { "data": "id", "name": "id" },
            { "data": "subject", "name": "subject" },
            { "data": "created_by_name", "name": "created_by_name" },
            { "data": "assigned_to_name", "name": "assigned_to_name" },
            { 
                "data": "status", 
                "name": "status",
                "render": function(data, type, row) {
                    if (data === 'open') {
                        return '<span class="badge badge-info">Открыт</span>';
                    } else if (data === 'in_progress') {
                        return '<span class="badge badge-warning">В работе</span>';
                    } else if (data === 'closed') {
                        return '<span class="badge badge-secondary">Закрыт</span>';
                    } else if (data === 'resolved') {
                        return '<span class="badge badge-success">Решен</span>';
                    }
                    return data;
                }
            },
            { 
                "data": "priority", 
                "name": "priority",
                "render": function(data, type, row) {
                    if (data === 'low') {
                        return '<span class="badge badge-default">Низкий</span>';
                    } else if (data === 'medium') {
                        return '<span class="badge badge-primary">Средний</span>';
                    } else if (data === 'high') {
                        return '<span class="badge badge-warning">Высокий</span>';
                    } else if (data === 'urgent') {
                        return '<span class="badge badge-danger">Срочный</span>';
                    }
                    return data;
                }
            },
            { "data": "messages_count", "name": "messages_count" },
            { "data": "created_at", "name": "created_at" },
            { 
                "data": "id", 
                "name": "actions",
                "orderable": false,
                "searchable": false,
                "render": function(data, type, row) {
                    var showUrl = '{{ route("admin.tickets.show", ":id") }}'.replace(':id', data);
                    var editUrl = '{{ route("admin.tickets.edit", ":id") }}'.replace(':id', data);
                    var destroyUrl = '{{ route("admin.tickets.destroy", ":id") }}'.replace(':id', data);
                    return '<a href="' + showUrl + '" class="btn btn-primary btn-xs" title="Просмотр"><i class="fa fa-eye"></i></a> ' +
                           '<a href="' + editUrl + '" class="btn btn-info btn-xs" title="Редактировать"><i class="fa fa-edit"></i></a> ' +
                           '<form action="' + destroyUrl + '" method="post" class="inline">' +
                           '<input type="hidden" name="_method" value="DELETE">' +
                           '<input type="hidden" name="_token" value="{{ csrf_token() }}">' +
                           '<button class="btn btn-danger btn-xs rest-destroy" title="Удалить"><i class="fa fa-trash"></i></button>' +
                           '</form>';
                }
            }
        ],
        "order": [[7, "desc"]], // Сортировка по дате создания по умолчанию
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
        $('#status').val(null).trigger('change');
        $('#priority').val(null).trigger('change');
        $('#created_by_user_id').val(null).trigger('change');
        $('#assigned_to_user_id').val(null).trigger('change');
        table.ajax.reload();
    });

    // Автоматическое применение фильтров при изменении
    $('#status, #priority').on('change', function() {
        table.ajax.reload();
    });
});
</script>
@endsection

