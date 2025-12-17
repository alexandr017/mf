@extends ('admin.layouts.app')
@section ('title', 'Создание категории')
@section ('h1', 'Создание категории')

@section('content')
    <form action="{{ route('admin.game-categories.store')}}" method="post">
        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">
        @include('admin.game-categories._form')
        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>
    </form>
    <div class="clearfix"></div>
    <br>
@stop


