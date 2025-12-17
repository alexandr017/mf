@extends('admin.layouts.app')
@section('title', 'Список вопросов-ответов')
@section('h1', 'Список вопросов-ответов')

@section('content')

    <a href="{{route('admin.faq.create')}}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Добавить вопрос-ответ</a>

    <br>
    <br>

    <table id="rowtbl" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>id</th>
            <th>Вопрос</th>
            <th>Порядок</th>
            <th>Статус</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($faqs as $faq)
            <tr>
                <td>{{ $faq->id }}</td>
                <td>{{ Str::limit($faq->question, 100) }}</td>
                <td>{{ $faq->order }}</td>
                <td>@if($faq->status) <span class="badge badge-success">Активен</span> @else <span class="badge badge-warning">Неактивен</span>@endif</td>
                <td>
                    <a href="{{route('admin.faq.edit', $faq->id) }}" class="btn btn-primary btn-xs" title="Редактировать"><i class="fa fa-edit"></i></a>
                    <form action="{{ route('admin.faq.destroy',$faq->id) }}" method="post" class="inline">
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



