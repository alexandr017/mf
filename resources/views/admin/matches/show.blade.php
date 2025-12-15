@extends('admin.layouts.app')
@section('title', 'Просмотр матча')
@section('h1', 'Просмотр матча')

@section('content')

    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>
                        {{ $match->homeTeam->name ?? 'TBD' }} vs {{ $match->awayTeam->name ?? 'TBD' }}
                    </h3>
                    <div>
                        @if($match->status === 'scheduled')
                            <span class="badge badge-info">Запланирован</span>
                        @elseif($match->status === 'played')
                            <span class="badge badge-success">Сыгран</span>
                        @elseif($match->status === 'cancelled')
                            <span class="badge badge-danger">Отменен</span>
                        @endif
                    </div>
                </div>
                <div class="panel-body">
                    <p><strong>Турнир:</strong> {{ $match->stage->season->tournament->name ?? '-' }}</p>
                    <p><strong>Сезон:</strong> {{ $match->stage->season->year_start ?? '-' }}/{{ $match->stage->season->year_finish ?? '-' }}</p>
                    <p><strong>Стадия:</strong> {{ $match->stage->name ?? '-' }}</p>
                    @if($match->group)
                        <p><strong>Группа:</strong> {{ $match->group->name }}</p>
                    @endif
                    <p><strong>Дата:</strong> {{ $match->date ? $match->date->format('d.m.Y H:i') : '-' }}</p>
                    @if($match->status === 'played')
                        <p><strong>Счет:</strong> {{ $match->score_1 ?? 0 }}:{{ $match->score_2 ?? 0 }}</p>
                        @if($match->pen_1 !== null && $match->pen_2 !== null)
                            <p><strong>Пенальти:</strong> {{ $match->pen_1 }}:{{ $match->pen_2 }}</p>
                        @endif
                    @endif
                </div>
            </div>

            <h4>События матча</h4>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Голы и передачи</strong>
                </div>
                <div class="panel-body">
                    @if($events->isEmpty())
                        <p>Событий пока нет</p>
                    @else
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Минута</th>
                                <th>Тип</th>
                                <th>Игрок</th>
                                <th>Описание</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($events as $event)
                                <tr>
                                    <td>{{ $event->minute }}'</td>
                                    <td>
                                        @if($event->type === 'goal')
                                            <span class="badge badge-success">Гол</span>
                                        @else
                                            <span class="badge badge-info">Передача</span>
                                        @endif
                                    </td>
                                    <td>{{ $event->user->name ?? '-' }}</td>
                                    <td>{{ $event->description ?? '-' }}</td>
                                    <td>
                                        <form action="{{ route('admin.matches.delete-event', [$match->id, $event->id]) }}" method="post" class="inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button class="btn btn-danger btn-xs" title="Удалить"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Добавить событие</div>
                <div class="panel-body">
                    <form action="{{ route('admin.matches.add-event', $match->id) }}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="minute">Минута:</label>
                                    <input type="number" class="form-control" name="minute" id="minute" min="1" max="120" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="type">Тип:</label>
                                    <select class="form-control" name="type" id="type" required>
                                        <option value="goal">Гол</option>
                                        <option value="assist">Передача</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user_id">Игрок:</label>
                                    <select class="form-control" name="user_id" id="user_id" required>
                                        <option value="">Выберите игрока</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Описание:</label>
                            <textarea class="form-control" name="description" id="description" rows="2"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Добавить</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <a href="{{route('admin.matches.edit', $match->id) }}" class="btn btn-info btn-block"><i class="fa fa-edit"></i> Редактировать матч</a>
            <a href="{{route('admin.matches.index') }}" class="btn btn-default btn-block"><i class="fa fa-arrow-left"></i> Назад к списку</a>
        </div>
    </div>

@endsection

