@extends('admin.layouts.app')
@section('title', 'Список шаблонов турниров')
@section('h1', 'Список шаблонов турниров')

@section('content')

    <a href="{{route('admin.tournament-templates.create')}}" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Добавить шаблон</a>

    <br>
    <br>

    <table id="rowtbl" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>id</th>
            <th>Название</th>
            <th>Тип</th>
            <th>По умолчанию</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($templates as $template)
            <tr>
                <td>{{ $template->id }}</td>
                <td>{{ $template->name }}</td>
                <td>{{ $template->type }}</td>
                <td>@if($template->is_default) <span class="badge badge-success">Да</span> @else <span class="badge badge-secondary">Нет</span>@endif</td>
                <td>
                    <a href="{{route('admin.tournament-templates.edit', $template->id) }}" class="btn btn-primary btn-xs" title="Редактировать"><i class="fa fa-edit"></i></a>
                    <form action="{{ route('admin.tournament-templates.destroy',$template->id) }}" method="post" class="inline">
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




