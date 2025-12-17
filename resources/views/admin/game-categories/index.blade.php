@extends('admin.layouts.app')
@section('title', 'Категории игр')
@section('h1', 'Категории игр')

@section('content')

    <a href="{{route('admin.game-categories.create')}}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Добавить категорию</a>

    <br>
    <br>

    <table id="rowtbl" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>id</th>
            <th>Название</th>
            <th>Алиас</th>
            <th>Порядок</th>
            <th>Статус</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->alias }}</td>
                <td>{{ $category->order }}</td>
                <td>@if($category->status) <span class="badge badge-success">Активна</span> @else <span class="badge badge-warning">Неактивна</span>@endif</td>
                <td>
                    <a href="{{route('admin.game-categories.edit', $category->id) }}" class="btn btn-primary btn-xs" title="Редактировать"><i class="fa fa-edit"></i></a>
                    <form action="{{ route('admin.game-categories.destroy',$category->id) }}" method="post" class="inline">
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


