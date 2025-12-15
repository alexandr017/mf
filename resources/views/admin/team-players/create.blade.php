@extends ('admin.layouts.app')
@section ('title', 'Добавление игрока в команду')
@section ('h1', 'Добавление игрока в команду')

@section('content')
    <form action="{{ route('admin.team-players.store')}}" method="post">
        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">
        @include('admin.team-players._form')
        <button type="submit" class="btn btn-success pull-right"><i class="fas fa-save"></i> Сохранить</button>
    </form>
    <div class="clearfix"></div>
    <br>
@stop

