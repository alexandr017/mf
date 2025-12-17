@extends ('admin.layouts.app')
@section ('title', 'Создание игры')
@section ('h1', 'Создание игры')

@section('content')
    <form action="{{ route('admin.games.store')}}" method="post">

        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

        @include('admin.games._form')

        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>

    </form>

    <div class="clearfix"></div>
    <br>
@stop


