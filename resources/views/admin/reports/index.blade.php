@extends('admin.layouts.app')
@section('title', 'Жалобы на пользователей')
@section('h1', 'Жалобы на пользователей')

@section('content')

    <a href="{{route('admin.reports.create')}}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Добавить жалобу</a>

    <br>
    <br>

    <table id="rowtbl" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>На кого пожаловались</th>
            <th>Кто пожаловался</th>
            <th>Категория</th>
            <th>Статус</th>
            <th>Дата создания</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($reports as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>
                    @if($item->reportedUser)
                        {{ $item->reportedUser->name }} (ID: {{ $item->reportedUser->id }})
                    @else
                        N/A
                    @endif
                </td>
                <td>
                    @if($item->reporterUser)
                        {{ $item->reporterUser->name }} (ID: {{ $item->reporterUser->id }})
                    @else
                        {{ $item->reporter_email ?: 'Анонимный пользователь' }}
                    @endif
                </td>
                <td>{{ $item->category_name }}</td>
                <td>
                    @if($item->status === 'pending')
                        <span class="badge bg-yellow">Ожидает</span>
                    @elseif($item->status === 'reviewed')
                        <span class="badge bg-blue">Рассмотрено</span>
                    @elseif($item->status === 'resolved')
                        <span class="badge bg-green">Решено</span>
                    @elseif($item->status === 'rejected')
                        <span class="badge bg-red">Отклонено</span>
                    @else
                        {{ $item->status }}
                    @endif
                </td>
                <td>{{ $item->created_at->format('d.m.Y H:i') }}</td>
                <td>
                    <a href="{{route('admin.reports.edit', $item->id) }}" class="btn btn-primary btn-xs" title="Редактировать"><i class="fa fa-edit"></i></a>
                    <form action="{{ route('admin.reports.destroy',$item->id) }}" method="post" class="inline">
                        {{ method_field('DELETE') }}
                        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">
                        <button class="btn btn-danger btn-xs rest-destroy" title="Удалить"><i class="fa fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $reports->links() }}
    </div>
@endsection

