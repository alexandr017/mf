@extends ('admin.layouts.app')
@section ('title', 'Редактирование команды')
@section ('h1', 'Редактирование команды')

@section('content')
    <form action="{{ route('admin.teams.update', $item->id) }}" method="post">

        {{ method_field('PATCH') }}

        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

        @include('admin.teams._form')

        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>

    </form>

    <div class="clearfix"></div>
    <br>
@stop




