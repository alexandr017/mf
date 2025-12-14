@extends('admin.layouts.app')
@section('title', 'Назначение достижения пользователям')
@section('h1', 'Назначение достижения: ' . $achievement->name)

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Выберите пользователей, которым назначить это достижение</h3>
        </div>
        <div class="panel-body">
            <form action="{{ route('admin.achievements.assign-users.update', $achievement->id) }}" method="post">
                <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">
                {{ method_field('PATCH') }}

                <div class="form-group">
                    <label>Пользователи</label>
                    <div style="max-height: 400px; overflow-y: auto; border: 1px solid #ddd; padding: 10px;">
                        @foreach($users as $user)
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="user_ids[]" value="{{$user->id}}"
                                           @if(in_array($user->id, $assignedUserIds)) checked @endif>
                                    {{$user->name}} ({{$user->email}})
                                    @if($user->rating)
                                        - Рейтинг: {{number_format($user->rating, 2)}}
                                    @endif
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Сохранить</button>
                <a href="{{route('admin.achievements.index')}}" class="btn btn-default">Отмена</a>
            </form>
        </div>
    </div>

@stop


