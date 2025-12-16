@extends('admin.layouts.app')
@section('title', 'Статистика рефералов')
@section('h1', 'Статистика рефералов')

@section('content')

    <!-- Статистика -->
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Всего приглашено</h3>
                </div>
                <div class="panel-body">
                    <h2>{{ $totalReferrals }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Всего рефереров</h3>
                </div>
                <div class="panel-body">
                    <h2>{{ $totalReferrers }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Среднее на реферера</h3>
                </div>
                <div class="panel-body">
                    <h2>{{ $totalReferrers > 0 ? round($totalReferrals / $totalReferrers, 2) : 0 }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Топ рефереров -->
    <div class="panel panel-default">
        <div class="panel-heading">Топ-10 рефереров</div>
        <div class="panel-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Пользователь</th>
                    <th>Реферальный код</th>
                    <th>Приглашено</th>
                </tr>
                </thead>
                <tbody>
                @foreach($topReferrers as $index => $referrer)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $referrer->name }} ({{ $referrer->email }})</td>
                        <td><code>{{ $referrer->referral_code ?? '-' }}</code></td>
                        <td><strong>{{ $referrer->referrals_count }}</strong></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Фильтры -->
    <div class="panel panel-default">
        <div class="panel-heading">Фильтры</div>
        <div class="panel-body">
            <form id="filters-form" class="form-inline">
                <div class="form-group">
                    <label for="referrer_id">Реферер:</label>
                    <select name="referrer_id" id="referrer_id" class="form-control select2-ajax" style="width: 250px;">
                        @if(request('referrer_id'))
                            @php
                                $selectedReferrer = \App\Models\User::find(request('referrer_id'));
                            @endphp
                            @if($selectedReferrer)
                                <option value="{{$selectedReferrer->id}}" selected>{{$selectedReferrer->name}} ({{$selectedReferrer->email}})</option>
                            @endif
                        @endif
                    </select>
                </div>
                <div class="form-group" style="margin-left: 15px;">
                    <label for="referred_id">Приглашенный:</label>
                    <select name="referred_id" id="referred_id" class="form-control select2-ajax" style="width: 250px;">
                        @if(request('referred_id'))
                            @php
                                $selectedReferred = \App\Models\User::find(request('referred_id'));
                            @endphp
                            @if($selectedReferred)
                                <option value="{{$selectedReferred->id}}" selected>{{$selectedReferred->name}} ({{$selectedReferred->email}})</option>
                            @endif
                        @endif
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

    <table id="referrals-table" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>id</th>
            <th>Приглашенный пользователь</th>
            <th>Реферер</th>
            <th>Реферальный код</th>
            <th>Дата регистрации</th>
        </tr>
        </thead>
        <tbody>
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
            url: '{{ route("admin.referrals.search-users") }}',
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

    $('#referrer_id, #referred_id').select2(userSelectConfig);

    // Инициализация DataTables с серверной обработкой
    var table = $('#referrals-table').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "{{ route('admin.referrals.data') }}",
            "type": "GET",
            "data": function (d) {
                // Добавляем фильтры к запросу
                d.referrer_id = $('#referrer_id').val();
                d.referred_id = $('#referred_id').val();
                d.date_from = $('#date_from').val();
                d.date_to = $('#date_to').val();
            }
        },
        "columns": [
            { "data": "id", "name": "id" },
            { "data": "referred_name", "name": "referred_name" },
            { "data": "referrer_name", "name": "referrer_name" },
            { "data": "referrer_code", "name": "referrer_code" },
            { "data": "created_at", "name": "created_at" }
        ],
        "order": [[4, "desc"]], // Сортировка по дате по умолчанию
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
        $('#referrer_id').val(null).trigger('change');
        $('#referred_id').val(null).trigger('change');
        $('#date_from').val('');
        $('#date_to').val('');
        table.ajax.reload();
    });

    // Автоматическое применение фильтров при изменении дат
    $('#date_from, #date_to').on('change', function() {
        table.ajax.reload();
    });
});
</script>
@endsection

