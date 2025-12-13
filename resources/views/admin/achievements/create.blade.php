@extends ('admin.layouts.app')
@section ('title', 'Создание достижения')
@section ('h1', 'Создание достижения')

@section('content')
    <form action="{{ route('admin.achievements.store')}}" method="post">

        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

        @include('admin.achievements._form')

        <button type="submit" class="btn btn-success pull-right"><i class="fas fa-save"></i> Сохранить</button>

    </form>

    <div class="clearfix"></div>
    <br>
@stop

