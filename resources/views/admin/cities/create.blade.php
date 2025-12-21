@extends ('admin.layouts.app')
@section ('title', 'Создание города')
@section ('h1', 'Создание города')

@section('content')
    <form action="{{ route('admin.cities.store')}}" method="post">

        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

        @include('admin.cities._form')

        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>

    </form>

    <div class="clearfix"></div>
    <br>
@stop




