@extends('admin.layouts.app')
@section('title', 'Список достижений')
@section('h1', 'Список достижений')

@section('content')

    <a href="{{route('admin.achievements.create')}}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Добавить достижение</a>

    <br>
    <br>

    <table id="rowtbl" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>id</th>
            <th>Название</th>
            <th>Описание</th>
            <th>Изображение</th>
            <th>Получено пользователями</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($achievements as $achievement)
            <tr>
                <td>{{ $achievement->id }}</td>
                <td>{{ $achievement->name }}</td>
                <td>{{ Str::limit($achievement->description, 50) }}</td>
                <td>
                    @if($achievement->image)
                        <img src="{{$achievement->image}}" alt="{{$achievement->name}}" style="max-width: 50px; max-height: 50px;">
                    @else
                        -
                    @endif
                </td>
                <td>{{ $achievement->users_count ?? 0 }}</td>
                <td>
                    <a href="{{route('admin.achievements.assign-users', $achievement->id) }}" class="btn btn-info btn-xs" title="Назначить пользователям"><i class="fa fa-user-plus"></i></a>
                    <a href="{{route('admin.achievements.edit', $achievement->id) }}" class="btn btn-primary btn-xs" title="Редактировать"><i class="fa fa-edit"></i></a>
                    <form action="{{ route('admin.achievements.destroy',$achievement->id) }}" method="post" class="inline">
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

