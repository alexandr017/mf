@extends('admin.layouts.app')
@section('title', 'Список страниц')
@section('h1', 'Список страниц')

@section('content')

    <a href="{{route('admin.static-pages.create')}}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Добавить страницу</a>

    <br>
    <br>

    <table id="rowtbl" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>id</th>
            <th>h1</th>
            <th>Ссылка</th>
{{--            <th>Статус</th>--}}
            <th>Рейтинг</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($staticPages as $staticPage)
            <tr>
                <td>{{ $staticPage->id }}</td>
                <td>{{ $staticPage->h1 }}</td>
                <td>{{ $staticPage->alias }}</td>
                <td>{{ $staticPage->average_rating }}</td>
{{--                <td>@if($staticPage->status) <span class="badge badge-success">Включена</span> @else <span class="badge badge-warning">Отключена</span>@endif</td>--}}
                <td>
                    <a href="/{{$staticPage->alias != '/' ? $staticPage->alias : ''}}" target="_blank" class="btn btn-info btn-xs" title="Открыть"><i class="fa fa-eye"></i></a>
                    <a href="{{route('admin.static-pages.edit', $staticPage->id) }}" class="btn btn-primary btn-xs" title="Редактировать"><i class="fa fa-edit"></i></a>
                    <form action="{{ route('admin.static-pages.destroy',$staticPage->id) }}" method="post" class="inline">
                        {{ method_field('DELETE') }}
                        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">
                        <button class="btn btn-danger btn-xs rest-destroy" title="Удалить"><i class="fa fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="clearfix"></div>
@endsection