@extends('admin.layouts.app')
@section('title', 'Просмотр тикета')
@section('h1', 'Просмотр тикета')

@section('content')

    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>{{ $ticket->subject }}</h3>
                    <div>
                        <span class="badge badge-{{ $ticket->status === 'open' ? 'info' : ($ticket->status === 'in_progress' ? 'warning' : ($ticket->status === 'closed' ? 'secondary' : 'success')) }}">
                            {{ $ticket->status === 'open' ? 'Открыт' : ($ticket->status === 'in_progress' ? 'В работе' : ($ticket->status === 'closed' ? 'Закрыт' : 'Решен')) }}
                        </span>
                        <span class="badge badge-{{ $ticket->priority === 'low' ? 'default' : ($ticket->priority === 'medium' ? 'primary' : ($ticket->priority === 'high' ? 'warning' : 'danger')) }}">
                            {{ $ticket->priority === 'low' ? 'Низкий' : ($ticket->priority === 'medium' ? 'Средний' : ($ticket->priority === 'high' ? 'Высокий' : 'Срочный')) }}
                        </span>
                    </div>
                </div>
                <div class="panel-body">
                    <p><strong>Создатель:</strong> {{ $ticket->createdBy->name ?? '-' }}</p>
                    <p><strong>Назначен:</strong> {{ $ticket->assignedTo->name ?? 'Не назначен' }}</p>
                    <p><strong>Создан:</strong> {{ $ticket->created_at->format('d.m.Y H:i') }}</p>
                    @if($ticket->closed_at)
                        <p><strong>Закрыт:</strong> {{ $ticket->closed_at->format('d.m.Y H:i') }}</p>
                    @endif
                </div>
            </div>

            <h4>Сообщения</h4>
            @foreach($ticket->messages as $message)
                <div class="panel panel-{{ $message->is_admin ? 'primary' : 'default' }}">
                    <div class="panel-heading">
                        <strong>{{ $message->user->name }}</strong>
                        @if($message->is_admin)
                            <span class="badge badge-primary">Администратор</span>
                        @endif
                        <span class="pull-right">{{ $message->created_at->format('d.m.Y H:i') }}</span>
                    </div>
                    <div class="panel-body">
                        {!! nl2br(e($message->message)) !!}
                    </div>
                </div>
            @endforeach

            <div class="panel panel-default">
                <div class="panel-heading">Добавить сообщение</div>
                <div class="panel-body">
                    <form action="{{ route('admin.tickets.add-message', $ticket->id) }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                        <div class="form-group">
                            <label for="message">Сообщение:</label>
                            <textarea class="form-control" name="message" id="message" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Отправить</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <a href="{{route('admin.tickets.edit', $ticket->id) }}" class="btn btn-info btn-block"><i class="fa fa-edit"></i> Редактировать</a>
            <a href="{{route('admin.tickets.index') }}" class="btn btn-default btn-block"><i class="fa fa-arrow-left"></i> Назад к списку</a>
        </div>
    </div>

@endsection

