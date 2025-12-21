@extends ('admin.layouts.app')
@section ('title', 'Редактирование категории')
@section ('h1', 'Редактирование категории')

@section('content')
    <form action="{{ route('admin.game-categories.update', $item->id) }}" method="post">
        {{ method_field('PATCH') }}
        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">
        @include('admin.game-categories._form')
        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>
    </form>
    <div class="clearfix"></div>
    <br>
@stop



