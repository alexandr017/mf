<div class="form-group">
    <label for="team_1"><i class="red">*</i> Команда 1</label>
    <select class="form-control select2" name="team_1" id="team_1" required style="width: 100%;">
        <option value="">Выберите команду</option>
        @php
            $teams = \App\Models\Teams\Team::orderBy('name')->get();
        @endphp
        @foreach($teams as $team)
            <option value="{{$team->id}}"
                    @if((old('team_1') == $team->id) || (isset($item) && $item->team_1 == $team->id))
                        selected
                    @endif>
                {{$team->name}}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="team_2"><i class="red">*</i> Команда 2</label>
    <select class="form-control select2" name="team_2" id="team_2" required style="width: 100%;">
        <option value="">Выберите команду</option>
        @php
            $teams = \App\Models\Teams\Team::orderBy('name')->get();
        @endphp
        @foreach($teams as $team)
            <option value="{{$team->id}}"
                    @if((old('team_2') == $team->id) || (isset($item) && $item->team_2 == $team->id))
                        selected
                    @endif>
                {{$team->name}}
            </option>
        @endforeach
    </select>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    $('#team_1, #team_2').select2({
        placeholder: 'Выберите команду',
        allowClear: true
    });
});
</script>

<div class="form-group">
    <label for="date"><i class="red">*</i> Дата и время</label>
    <input type="datetime-local" class="form-control" name="date" id="date" required
           @if(old('date'))
               value="{{old('date')}}"
           @else
               @if(isset($item) && $item->date)
                   value="{{$item->date->format('Y-m-d\TH:i')}}"
            @endif
            @endif
    >
</div>

<div class="form-group">
    <label for="score_1">Счет команды 1</label>
    <input type="number" class="form-control" name="score_1" id="score_1" min="0" max="255"
           @if(old('score_1') !== null)
               value="{{old('score_1')}}"
           @else
               @if(isset($item) && $item->score_1 !== null)
                   value="{{$item->score_1}}"
            @endif
            @endif
    >
</div>

<div class="form-group">
    <label for="score_2">Счет команды 2</label>
    <input type="number" class="form-control" name="score_2" id="score_2" min="0" max="255"
           @if(old('score_2') !== null)
               value="{{old('score_2')}}"
           @else
               @if(isset($item) && $item->score_2 !== null)
                   value="{{$item->score_2}}"
            @endif
            @endif
    >
</div>

<div class="form-group">
    <label for="status"><i class="red">*</i> Статус</label>
    <select class="form-control" name="status" id="status" required>
        <option value="scheduled" @if((old('status') == 'scheduled') || (isset($item) && $item->status == 'scheduled')) selected @endif>Запланирован</option>
        <option value="played" @if((old('status') == 'played') || (isset($item) && $item->status == 'played')) selected @endif>Сыгран</option>
        <option value="cancelled" @if((old('status') == 'cancelled') || (isset($item) && $item->status == 'cancelled')) selected @endif>Отменен</option>
    </select>
</div>

