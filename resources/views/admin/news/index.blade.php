@extends('admin.layouts.app')
@section('title', 'Список новостей')
@section('h1', 'Список новостей')

@section('content')

    <a href="{{route('admin.news.create')}}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Добавить новость</a>

    <br>
    <br>

    <table id="rowtbl" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>id</th>
            <th>Заголовок</th>
            <th>Алиас</th>
            <th>Дата публикации</th>
            <th>Статус</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($news as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->alias }}</td>
                <td>{{ $item->published_at ? $item->published_at->format('d.m.Y H:i') : '-' }}</td>
                <td>@if($item->status) <span class="badge badge-success">Опубликована</span> @else <span class="badge badge-warning">Черновик</span>@endif</td>
                <td>
                    @if($item->alias)
                        <a href="/blog/{{$item->alias}}" target="_blank" class="btn btn-info btn-xs" title="Открыть"><i class="fa fa-eye"></i></a>
                    @endif
                    <a href="{{route('admin.news.edit', $item->id) }}" class="btn btn-primary btn-xs" title="Редактировать"><i class="fa fa-edit"></i></a>
                    <form action="{{ route('admin.news.destroy',$item->id) }}" method="post" class="inline">
                        {{ method_field('DELETE') }}
                        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">
                        <button class="btn btn-danger btn-xs rest-destroy" title="Удалить"><i class="fa fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection





