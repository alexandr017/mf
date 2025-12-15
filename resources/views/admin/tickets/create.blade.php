@extends ('admin.layouts.app')
@section ('title', 'Создание тикета')
@section ('h1', 'Создание тикета')

@section('content')
    <form action="{{ route('admin.tickets.store')}}" method="post">
        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">
        @include('admin.tickets._form')
        <button type="submit" class="btn btn-success pull-right"><i class="fas fa-save"></i> Создать</button>
    </form>
    <div class="clearfix"></div>
    <br>
@stop

