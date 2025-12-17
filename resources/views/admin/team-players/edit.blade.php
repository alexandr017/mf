@extends ('admin.layouts.app')
@section ('title', 'Редактирование состава')
@section ('h1', 'Редактирование состава')

@section('content')
    <form action="{{ route('admin.team-players.update', $item->id) }}" method="post">
        {{ method_field('PATCH') }}
        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">
        @include('admin.team-players._form')
        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>
    </form>
    <div class="clearfix"></div>
    <br>
@stop


