@extends ('admin.layouts.app')
@section ('title', 'Создание страницы')
@section ('h1', 'Создание страницы')

@section('content')
    <form action="{{ route('admin.static-pages.store')}}" method="post">

        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

        @include('admin.static-pages._form')

        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>

    </form>

    <div class="clearfix"></div>
    <br>
@stop

