@extends('admin.layouts.app')
@section('title', 'Список турниров')
@section('h1', 'Список турниров')

@section('content')

    <a href="{{route('admin.tournaments.create')}}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Добавить турнир</a>

    <br>
    <br>

    <table id="rowtbl" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>id</th>
            <th>Название</th>
            <th>Тип</th>
            <th>Страна</th>
            <th>Цвет</th>
            <th>Участников</th>
            <th>Алиас</th>
            <th>Статус</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($tournaments as $tournament)
            @php
                $country = $tournament->country_id ? \App\Models\Countries\Country::find($tournament->country_id) : null;
            @endphp
            <tr>
                <td>{{ $tournament->id }}</td>
                <td>{{ $tournament->name }}</td>
                <td>{{ $tournament->type }}</td>
                <td>{{ $country ? $country->name : 'СНГ' }}</td>
                <td>
                    @if($tournament->color)
                        <span class="badge" style="background-color: {{ $tournament->color }}; color: {{ $tournament->color == '#7FFF00' ? '#000' : '#fff' }};">
                            {{ $tournament->color }}
                        </span>
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>
                <td>{{ $tournament->participants_count ?? 0 }}</td>
                <td>{{ $tournament->alias }}</td>
                <td>@if($tournament->status) <span class="badge badge-success">Активен</span> @else <span class="badge badge-warning">Неактивен</span>@endif</td>
                <td>
                    @if($tournament->alias)
                        <a href="/tournaments/{{$tournament->alias}}" target="_blank" class="btn btn-info btn-xs" title="Открыть"><i class="fa fa-eye"></i></a>
                    @endif
                    <a href="{{route('admin.tournaments.edit', $tournament->id) }}" class="btn btn-primary btn-xs" title="Редактировать"><i class="fa fa-edit"></i></a>
                    <form action="{{ route('admin.tournaments.destroy',$tournament->id) }}" method="post" class="inline">
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



