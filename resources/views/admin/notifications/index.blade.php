@extends('admin.layouts.app')
@section('title', 'Массовые уведомления')
@section('h1', 'Массовые уведомления')

@section('content')

    <a href="{{route('admin.notifications.create')}}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Создать уведомление</a>

    <br>
    <br>

    <table id="rowtbl" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>id</th>
            <th>Заголовок</th>
            <th>Создал</th>
            <th>Запланировано</th>
            <th>Отправлено</th>
            <th>Статус</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($notifications as $notification)
            <tr>
                <td>{{ $notification->id }}</td>
                <td>{{ $notification->title }}</td>
                <td>{{ $notification->createdBy->name ?? '-' }}</td>
                <td>{{ $notification->scheduled_at ? $notification->scheduled_at->format('d.m.Y H:i') : 'Сразу' }}</td>
                <td>{{ $notification->userNotifications()->count() }}</td>
                <td>
                    @if($notification->userNotifications()->exists())
                        <span class="badge badge-success">Отправлено</span>
                    @elseif($notification->scheduled_at && $notification->scheduled_at > now())
                        <span class="badge badge-warning">Запланировано</span>
                    @else
                        <span class="badge badge-info">В ожидании</span>
                    @endif
                </td>
                <td>
                    <a href="{{route('admin.notifications.show', $notification->id) }}" class="btn btn-info btn-xs" title="Просмотр"><i class="fa fa-eye"></i></a>
                    @if(!$notification->userNotifications()->exists())
                        <a href="{{route('admin.notifications.edit', $notification->id) }}" class="btn btn-primary btn-xs" title="Редактировать"><i class="fa fa-edit"></i></a>
                        <form action="{{ route('admin.notifications.destroy',$notification->id) }}" method="post" class="inline">
                            {{ method_field('DELETE') }}
                            <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">
                            <button class="btn btn-danger btn-xs rest-destroy" title="Удалить"><i class="fa fa-trash"></i></button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection

