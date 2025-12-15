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
            <select class="form-control" name="created_by_user_id" id="created_by_user_id">
                <option value="">Не выбран</option>
                @foreach($users as $user)
                    <option value="{{$user->id}}"
                            @if((old('created_by_user_id') == $user->id) || (isset($ticket) && $ticket->created_by_user_id == $user->id))
                                selected
                            @endif>
                        {{$user->name}}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="assigned_to_user_id">Назначен</label>
            <select class="form-control" name="assigned_to_user_id" id="assigned_to_user_id">
                <option value="">Не назначен</option>
                @foreach($users as $user)
                    <option value="{{$user->id}}"
                            @if((old('assigned_to_user_id') == $user->id) || (isset($ticket) && $ticket->assigned_to_user_id == $user->id))
                                selected
                            @endif>
                        {{$user->name}}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

