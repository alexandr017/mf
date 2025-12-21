@extends('admin.layouts.app')
@section('title', 'Редактировать жалобу')
@section('h1', 'Редактировать жалобу')

@section('content')
@if(isset($breadcrumbs))
    @include('admin.includes.partials.breadcrumbs-vzo', ['breadcrumbs' => $breadcrumbs])
@endif

<form action="{{ route('admin.reports.update', $item->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="form-group">
        <label>Пользователь, на которого пожаловались</label>
        <input type="text" class="form-control" value="{{ $item->reportedUser->name ?? 'N/A' }} (ID: {{ $item->reported_user_id }})" disabled>
    </div>

    <div class="form-group">
        <label>Кто пожаловался</label>
        @if($item->reporterUser)
            <input type="text" class="form-control" value="{{ $item->reporterUser->name }} (ID: {{ $item->reporterUser->id }})" disabled>
        @else
            <input type="text" class="form-control" value="{{ $item->reporter_email ?: 'Анонимный пользователь' }}" disabled>
        @endif
    </div>

    <div class="form-group">
        <label>Категория нарушения</label>
        <input type="text" class="form-control" value="{{ $item->category_name }}" disabled>
    </div>

    <div class="form-group">
        <label>Описание</label>
        <textarea class="form-control" rows="5" disabled>{{ $item->description }}</textarea>
    </div>

    <div class="form-group">
        <label for="status">Статус *</label>
        <select class="form-control" id="status" name="status" required>
            <option value="pending" {{ $item->status === 'pending' ? 'selected' : '' }}>Ожидает</option>
            <option value="reviewed" {{ $item->status === 'reviewed' ? 'selected' : '' }}>Рассмотрено</option>
            <option value="resolved" {{ $item->status === 'resolved' ? 'selected' : '' }}>Решено</option>
            <option value="rejected" {{ $item->status === 'rejected' ? 'selected' : '' }}>Отклонено</option>
        </select>
    </div>

    <div class="form-group">
        <label for="admin_notes">Заметки администратора</label>
        <textarea class="form-control" id="admin_notes" name="admin_notes" rows="5">{{ $item->admin_notes }}</textarea>
    </div>

    @if($item->reviewer)
        <div class="form-group">
            <label>Рассмотрено</label>
            <input type="text" class="form-control" value="{{ $item->reviewer->name }} ({{ $item->reviewed_at->format('d.m.Y H:i') }})" disabled>
        </div>
    @endif

    <button type="submit" class="btn btn-primary">Сохранить</button>
    <a href="{{ route('admin.reports.index') }}" class="btn btn-default">Отмена</a>
</form>

@endsection

