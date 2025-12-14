@extends('admin.layouts.app')
@section('title', 'Список городов')
@section('h1', 'Список городов')

@section('content')

    <a href="{{route('admin.cities.create')}}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Добавить город</a>

    <br>
    <br>

    <table id="rowtbl" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>id</th>
            <th>Название</th>
            <th>IP</th>
            <th>RP</th>
            <th>DP</th>
            <th>VP</th>
            <th>TP</th>
            <th>MP</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($cities as $city)
            <tr>
                <td>{{ $city->id }}</td>
                <td>{{ $city->name }}</td>
                <td>{{ $city->ip }}</td>
                <td>{{ $city->rp }}</td>
                <td>{{ $city->dp }}</td>
                <td>{{ $city->vp }}</td>
                <td>{{ $city->tp }}</td>
                <td>{{ $city->mp }}</td>
                <td>
                    <a href="{{route('admin.cities.edit', $city->id) }}" class="btn btn-primary btn-xs" title="Редактировать"><i class="fa fa-edit"></i></a>
                    <form action="{{ route('admin.cities.destroy',$city->id) }}" method="post" class="inline">
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


