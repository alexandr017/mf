@extends('admin.layouts.app')
@section('title', 'Список пользователей')
@section('h1', 'Список пользователей')

@section('content')

    <a href="{{route('admin.users.create')}}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Добавить пользователя</a>

    <br>
    <br>

    <table id="rowtbl" class="table table-striped table-bordered table-hover">
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
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->goals ?? 0 }}</td>
                <td>{{ $user->assists ?? 0 }}</td>
                <td>{{ number_format($user->rating ?? 0, 2) }}</td>
                <td>{{ $user->referrals_count ?? 0 }}</td>
                <td>
                    <a href="{{route('admin.users.edit', $user->id) }}" class="btn btn-primary btn-xs" title="Редактировать"><i class="fa fa-edit"></i></a>
                    <form action="{{ route('admin.users.destroy',$user->id) }}" method="post" class="inline">
                        {{ method_field('DELETE') }}
                        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">
                        <button class="btn btn-danger btn-xs rest-destroy" title="Удалить"><i class="fa fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="text-center">
        {{ $users->links() }}
    </div>
@endsection


