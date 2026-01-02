@extends('admin.layouts.app')
@section('title', 'Просмотр массового уведомления')
@section('h1', 'Просмотр массового уведомления')

@section('content')

    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>{{ $notification->title }}</h3>
                </div>
                <div class="panel-body">
                    <p><strong>Заголовок:</strong> {{ $notification->title }}</p>
                    <p><strong>Сообщение:</strong></p>
                    <div class="well">{{ $notification->message }}</div>
                    <p><strong>Создал:</strong> {{ $notification->createdBy->name ?? '-' }}</p>
                    <p><strong>Создано:</strong> {{ $notification->created_at->format('d.m.Y H:i') }}</p>
                    @if($notification->scheduled_at)
                        <p><strong>Запланировано на:</strong> {{ $notification->scheduled_at->format('d.m.Y H:i') }}</p>
                    @else
                        <p><strong>Запланировано:</strong> Сразу</p>
                    @endif
                    <p><strong>Отправлено пользователям:</strong> {{ $sentCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            @if(!$notification->userNotifications()->exists())
                <a href="{{route('admin.notifications.edit', $notification->id) }}" class="btn btn-info btn-block"><i class="fa fa-edit"></i> Редактировать</a>
            @endif
            <a href="{{route('admin.notifications.index') }}" class="btn btn-default btn-block"><i class="fa fa-arrow-left"></i> Назад к списку</a>
        </div>
    </div>

@endsection

