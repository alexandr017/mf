@extends ('admin.layouts.app')
@section ('title', 'Редактирование тикета')
@section ('h1', 'Редактирование тикета')

@section('content')
    <form action="{{ route('admin.tickets.update', $ticket->id) }}" method="post">
        {{ method_field('PATCH') }}
        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">
        @include('admin.tickets._form')
        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>
    </form>
    <div class="clearfix"></div>
    <br>
@stop




