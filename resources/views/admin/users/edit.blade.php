@extends ('admin.layouts.app')
@section ('title', 'Редактирование пользователя')
@section ('h1', 'Редактирование пользователя')

@section('content')
    <form action="{{ route('admin.users.update', $item->id) }}" method="post">

        {{ method_field('PATCH') }}

        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

        @include('admin.users._form')

        <button type="submit" class="btn btn-success pull-right"><i class="fas fa-save"></i> Сохранить</button>

    </form>

    <div class="clearfix"></div>
    <br>
@stop

