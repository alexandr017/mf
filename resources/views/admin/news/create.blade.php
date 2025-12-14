@extends ('admin.layouts.app')
@section ('title', 'Создание новости')
@section ('h1', 'Создание новости')

@section('content')
    <form action="{{ route('admin.news.store')}}" method="post">

        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

        @include('admin.news._form')

        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>

    </form>

    <div class="clearfix"></div>
    <br>
@stop


