@extends ('admin.layouts.app')
@section ('title', 'Создание сезона')
@section ('h1', 'Создание сезона')

@section('content')
    <form action="{{ route('admin.tournament-seasons.store')}}" method="post" id="seasonForm">

        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

        @include('admin.tournament-seasons._form')

        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>

    </form>

    <div class="clearfix"></div>
    <br>
@stop



