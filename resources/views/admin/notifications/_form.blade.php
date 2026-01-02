@php
    $item = $notification ?? null;
@endphp

<form method="POST" action="@if(isset($item)) {{route('admin.notifications.update', $item->id)}} @else {{route('admin.notifications.store')}} @endif">
    {{ csrf_field() }}
    @if(isset($item))
        {{ method_field('PUT') }}
    @endif

    <div class="form-group">
        <label for="title">Заголовок <i class="red">*</i></label>
        <input type="text" class="form-control" name="title" id="title" value="{{old('title', $item->title ?? '')}}" required maxlength="255">
    </div>

    <div class="form-group">
        <label for="message">Сообщение <i class="red">*</i></label>
        <textarea class="form-control" name="message" id="message" rows="10" required minlength="10" maxlength="5000">{{old('message', $item->message ?? '')}}</textarea>
        <small class="form-text text-muted">Минимум 10 символов, максимум 5000</small>
    </div>

    <div class="form-group">
        <label for="scheduled_at">Запланированная отправка</label>
        <input type="datetime-local" class="form-control" name="scheduled_at" id="scheduled_at" value="{{old('scheduled_at', isset($item->scheduled_at) ? $item->scheduled_at->format('Y-m-d\TH:i') : '')}}">
        <small class="form-text text-muted">Оставьте пустым для немедленной отправки</small>
    </div>

    <button type="submit" class="btn btn-primary">@if(isset($item)) Сохранить @else Создать @endif</button>
    <a href="{{route('admin.notifications.index')}}" class="btn btn-default">Отмена</a>
</form>

