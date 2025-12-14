@extends ('admin.layouts.app')
@section ('title', 'Создание страны')
@section ('h1', 'Создание страны')

@section('content')
    <form action="{{ route('admin.countries.store')}}" method="post">

        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

        @include('admin.countries._form')

        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>

    </form>

    <div class="clearfix"></div>
    <br>
@stop


