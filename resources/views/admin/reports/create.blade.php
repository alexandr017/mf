@extends('admin.layouts.app')
@section('title', 'Добавить жалобу')
@section('h1', 'Добавить жалобу')

@section('content')
@if(isset($breadcrumbs))
    @include('admin.includes.partials.breadcrumbs-vzo', ['breadcrumbs' => $breadcrumbs])
@endif

<form action="{{ route('admin.reports.store') }}" method="POST">
    @csrf
    
    <div class="form-group">
        <label for="reported_user_id">Пользователь, на которого жалуются *</label>
        <input type="number" class="form-control" id="reported_user_id" name="reported_user_id" required>
    </div>

    <div class="form-group">
        <label for="reporter_user_id">Пользователь, который жалуется (ID, необязательно)</label>
        <input type="number" class="form-control" id="reporter_user_id" name="reporter_user_id">
    </div>

    <div class="form-group">
        <label for="reporter_email">Email жалобщика (для незарегистрированных)</label>
        <input type="email" class="form-control" id="reporter_email" name="reporter_email">
    </div>

    <div class="form-group">
        <label for="category_id">Категория нарушения *</label>
        <select class="form-control" id="category_id" name="category_id" required>
            <option value="">Выберите категорию...</option>
            @foreach($categories as $id => $name)
                <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="description">Описание</label>
        <textarea class="form-control" id="description" name="description" rows="5"></textarea>
    </div>

    <div class="form-group">
        <label for="status">Статус *</label>
        <select class="form-control" id="status" name="status" required>
            <option value="pending">Ожидает</option>
            <option value="reviewed">Рассмотрено</option>
            <option value="resolved">Решено</option>
            <option value="rejected">Отклонено</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Сохранить</button>
    <a href="{{ route('admin.reports.index') }}" class="btn btn-default">Отмена</a>
</form>

@endsection

