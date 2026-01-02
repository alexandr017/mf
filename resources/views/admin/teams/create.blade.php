@extends ('admin.layouts.app')
@section ('title', 'Создание команды')
@section ('h1', 'Создание команды')

@section('content')
    <form action="{{ route('admin.teams.store')}}" method="post">

        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

        @include('admin.teams._form')

        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>

    </form>

    <div class="clearfix"></div>
    <br>
@stop





