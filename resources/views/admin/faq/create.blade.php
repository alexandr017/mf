@extends ('admin.layouts.app')
@section ('title', 'Создание вопроса-ответа')
@section ('h1', 'Создание вопроса-ответа')

@section('content')
    <form action="{{ route('admin.faq.store')}}" method="post">

        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

        @include('admin.faq._form')

        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>

    </form>

    <div class="clearfix"></div>
    <br>
@stop




