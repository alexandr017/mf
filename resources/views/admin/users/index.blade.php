@extends('admin.layouts.app')
@section('title', 'Список пользователей')
@section('h1', 'Список пользователей')

@section('content')

    <a href="{{route('admin.users.create')}}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Добавить пользователя</a>

    <br>
    <br>

    <table id="users-table" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>id</th>
            <th>Имя</th>
            <th>Email</th>
            <th>Голы</th>
            <th>Передачи</th>
            <th>Рейтинг</th>
            <th>Рефералов</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
@endsection

@section('after-scripts')
<script>
$(document).ready(function(){
    $("#users-table").DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "{{ route('admin.users.data') }}",
            "type": "GET",
            "data": function (d) {
                // Можно добавить дополнительные параметры поиска
            }
        },
        "columns": [
            { "data": "id", "name": "id" },
            { "data": "name", "name": "name" },
            { "data": "email", "name": "email" },
            { "data": "goals", "name": "goals" },
            { "data": "assists", "name": "assists" },
            { "data": "rating", "name": "rating" },
            { "data": "referrals_count", "name": "referrals_count" },
            { "data": "actions", "name": "actions", "orderable": false, "searchable": false }
        ],
        "order": [[5, "desc"], [3, "desc"], [1, "asc"]], // Сортировка по умолчанию: рейтинг desc, голы desc, имя asc
        "pageLength": 50,
        "language": {"url": "/admin-assets/dataTables/datatables.json"},
        "searching": true,
        "lengthChange": true,
        "paging": true,
        "info": true
    });
});
</script>
@endsection


