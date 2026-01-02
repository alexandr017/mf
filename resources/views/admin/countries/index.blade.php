@extends('admin.layouts.app')
@section('title', 'Список стран')
@section('h1', 'Список стран')

@section('content')

    <a href="{{route('admin.countries.create')}}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Добавить страну</a>

    <br>
    <br>

    <table id="rowtbl" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>id</th>
            <th>Название</th>
            <th>Код</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($countries as $country)
            <tr>
                <td>{{ $country->id }}</td>
                <td>{{ $country->name }}</td>
                <td>{{ $country->code }}</td>
                <td>
                    <a href="{{route('admin.countries.edit', $country->id) }}" class="btn btn-primary btn-xs" title="Редактировать"><i class="fa fa-edit"></i></a>
                    <form action="{{ route('admin.countries.destroy',$country->id) }}" method="post" class="inline">
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





