@extends ('admin.layouts.app')
@section ('title', 'Редактирование товарищеского матча')
@section ('h1', 'Редактирование товарищеского матча')

@section('content')
    <form action="{{ route('admin.friendly-matches.update', $item->id)}}" method="post">

        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">
        {{ method_field('PUT') }}

        @include('admin.friendly-matches._form')

        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>

    </form>

    <div class="clearfix"></div>
    <br>
@stop

