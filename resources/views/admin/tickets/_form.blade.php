<div class="form-group">
    <label for="subject"><i class="red">*</i> Тема</label>
    <input type="text" class="form-control" name="subject" id="subject" required
           @if(old('subject'))
               value="{{old('subject')}}"
           @else
               @if(isset($ticket))
                   value="{{$ticket->subject}}"
            @endif
            @endif
    >
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="status"><i class="red">*</i> Статус</label>
            <select class="form-control" name="status" id="status" required>
                <option value="open" @if((old('status') == 'open') || (isset($ticket) && $ticket->status == 'open')) selected @endif>Открыт</option>
                <option value="in_progress" @if((old('status') == 'in_progress') || (isset($ticket) && $ticket->status == 'in_progress')) selected @endif>В работе</option>
                <option value="closed" @if((old('status') == 'closed') || (isset($ticket) && $ticket->status == 'closed')) selected @endif>Закрыт</option>
                <option value="resolved" @if((old('status') == 'resolved') || (isset($ticket) && $ticket->status == 'resolved')) selected @endif>Решен</option>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="priority"><i class="red">*</i> Приоритет</label>
            <select class="form-control" name="priority" id="priority" required>
                <option value="low" @if((old('priority') == 'low') || (isset($ticket) && $ticket->priority == 'low')) selected @endif>Низкий</option>
                <option value="medium" @if((old('priority') == 'medium') || (isset($ticket) && $ticket->priority == 'medium')) selected @endif>Средний</option>
                <option value="high" @if((old('priority') == 'high') || (isset($ticket) && $ticket->priority == 'high')) selected @endif>Высокий</option>
                <option value="urgent" @if((old('priority') == 'urgent') || (isset($ticket) && $ticket->priority == 'urgent')) selected @endif>Срочный</option>
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="created_by_user_id">Создатель</label>
            @if(isset($ticket))
                {{-- При редактировании: поле только для чтения --}}
                <input type="hidden" name="created_by_user_id" value="{{$ticket->created_by_user_id}}">
                <select class="form-control" id="created_by_user_id" disabled style="width: 100%;">
                    @if($ticket->createdBy)
                        <option value="{{$ticket->created_by_user_id}}" selected>{{$ticket->createdBy->name}} ({{$ticket->createdBy->email}})</option>
                    @else
                        <option value="">Не указан</option>
                    @endif
                </select>
                <small class="form-text text-muted">Создатель не может быть изменен</small>
            @else
                {{-- При создании: автоматически устанавливаем текущего админа --}}
                <select class="form-control select2-ajax" name="created_by_user_id" id="created_by_user_id" data-placeholder="Выберите пользователя" style="width: 100%;">
                    @if(auth()->check())
                        <option value="{{auth()->id()}}" selected>{{auth()->user()->name}} ({{auth()->user()->email}})</option>
                    @endif
                </select>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="assigned_to_user_id">Назначен</label>
            <select class="form-control select2-ajax" name="assigned_to_user_id" id="assigned_to_user_id" data-placeholder="Выберите пользователя" style="width: 100%;">
                @if(isset($ticket) && $ticket->assigned_to_user_id && $ticket->assignedTo)
                    <option value="{{$ticket->assigned_to_user_id}}" selected>{{$ticket->assignedTo->name}} ({{$ticket->assignedTo->email}})</option>
                @endif
            </select>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    @if(!isset($ticket))
    // Инициализация select2 для created_by_user_id (только при создании)
    $('#created_by_user_id').select2({
        ajax: {
            url: '{{ route("admin.tickets.search-users") }}',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term,
                    page: params.page || 1
                };
            },
            processResults: function (data) {
                return {
                    results: data.results
                };
            },
            cache: true
        },
        minimumInputLength: 1,
        placeholder: 'Выберите пользователя',
        allowClear: false
    });
    @endif

    // Инициализация select2 для assigned_to_user_id
    $('#assigned_to_user_id').select2({
        ajax: {
            url: '{{ route("admin.tickets.search-users") }}',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term,
                    page: params.page || 1
                };
            },
            processResults: function (data) {
                return {
                    results: data.results
                };
            },
            cache: true
        },
        minimumInputLength: 1,
        placeholder: 'Выберите пользователя',
        allowClear: true
    });
});
</script>

