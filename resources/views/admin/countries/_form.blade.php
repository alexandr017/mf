<div class="form-group">
    <label for="name"><i class="red">*</i> Название страны</label>
    <input type="text" class="form-control" name="name" id="name" required
           @if(old('name'))
               value="{{old('name')}}"
           @else
               @if(isset($item))
                   value="{{$item->name}}"
            @endif
            @endif
    >
</div>

<div class="form-group">
    <label for="code">Код страны (ISO)</label>
    <input type="text" class="form-control" name="code" id="code" maxlength="3"
           @if(old('code'))
               value="{{old('code')}}"
           @else
               @if(isset($item))
                   value="{{$item->code}}"
            @endif
            @endif
    >
    <small class="form-text text-muted">Трехбуквенный код страны (например: RUS, USA, GER)</small>
</div>



