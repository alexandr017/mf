@extends ('admin.layouts.app')
@section ('title', 'Создание пользователя')
@section ('h1', 'Создание пользователя')

@section('content')
    <form action="{{ route('admin.users.store')}}" method="post">

        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

        @include('admin.users._form')

        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>

    </form>

    <div class="clearfix"></div>
    <br>
@stop


