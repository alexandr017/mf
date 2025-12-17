@include('admin.includes.partials.seo-fields')

<div class="form-group">
    <label for="name"><i class="red">*</i> Название турнира</label>
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
    <label for="country_id">Страна</label>
    <select class="form-control" name="country_id" id="country_id">
        <option value=""
                @if((old('country_id') === '' || old('country_id') === null) || (isset($item) && ($item->country_id === null || $item->country_id === '')))
                    selected
                @endif>
            СНГ (без страны)
        </option>
        @php
            $countries = \App\Models\Countries\Country::orderBy('name')->get();
        @endphp
        @foreach($countries as $country)
            <option value="{{$country->id}}"
                    @if((old('country_id') == $country->id) || (isset($item) && $item->country_id == $country->id))
                        selected
                    @endif>
                {{$country->name}}
            </option>
        @endforeach
    </select>
    <small class="form-text text-muted">Выберите страну или оставьте пустым для СНГ</small>
</div>

<div class="form-group">
    <label for="alias">Постоянная ссылка:</label> <span class="btn btn-default btn-xs translate"><i class="fa fa-language"></i></span>
    <input type="text" class="form-control" name="alias" id="alias"
           @if(old('alias'))
               value="{{old('alias')}}"
           @else
               @if(isset($item))
                   value="{{$item->alias}}"
            @endif
            @endif
    >
</div>

<div class="form-group">
    <label for="type"><i class="red">*</i> Тип турнира</label>
    <select class="form-control" name="type" id="type" required>
        <option value="">Выберите тип</option>
        <option value="league" @if((old('type') == 'league') || (isset($item) && $item->type == 'league')) selected @endif>Лига</option>
        <option value="cup" @if((old('type') == 'cup') || (isset($item) && $item->type == 'cup')) selected @endif>Кубок</option>
        <option value="supercup" @if((old('type') == 'supercup') || (isset($item) && $item->type == 'supercup')) selected @endif>Суперкубок</option>
        <option value="mixed" @if((old('type') == 'mixed') || (isset($item) && $item->type == 'mixed')) selected @endif>Смешанный</option>
    </select>
</div>

<div class="form-group">
    <label for="tournament_template_id">Шаблон турнира</label>
    <select class="form-control" name="tournament_template_id" id="tournament_template_id">
        <option value="">Без шаблона</option>
        @php
            $templates = \App\Models\Tournaments\TournamentTemplate::orderBy('type')->orderBy('name')->get();
        @endphp
        @foreach($templates as $template)
            <option value="{{$template->id}}"
                    @if((old('tournament_template_id') == $template->id) || (isset($item) && $item->tournament_template_id == $template->id))
                        selected
                    @endif
                    data-type="{{$template->type}}">
                {{$template->name}} ({{$template->type}})
            </option>
        @endforeach
    </select>
    <small class="form-text text-muted">Выберите шаблон для автоматической генерации структуры сезонов</small>
</div>

<div class="form-group">
    <label for="image">Изображение</label>
    <input type="text" class="form-control" name="image" id="image"
           @if(old('image'))
               value="{{old('image')}}"
           @else
               @if(isset($item))
                   value="{{$item->image}}"
            @endif
            @endif
    >
</div>

<div class="form-group">
    <label for="color">Цвет (HEX)</label>
    <div class="input-group">
        <input type="text" class="form-control" name="color" id="color" maxlength="7" placeholder="#7FFF00"
               @if(old('color'))
                   value="{{old('color')}}"
               @else
                   @if(isset($item))
                       value="{{$item->color}}"
                @endif
                @endif
        >
        <div class="input-group-append">
            <input type="color" class="form-control" id="colorPicker" style="width: 50px; height: 38px; cursor: pointer;"
                   @if(old('color') || (isset($item) && $item->color))
                       value="{{old('color') ?: ($item->color ?? '#7FFF00')}}"
                   @else
                       value="#7FFF00"
                   @endif
                   onchange="document.getElementById('color').value = this.value;">
        </div>
    </div>
    <small class="form-text text-muted">Цвет для наведения на карточке турнира (формат HEX: #7FFF00)</small>
</div>

<div class="form-group">
    <label for="participants_count">Количество участников</label>
    <input type="number" class="form-control" name="participants_count" id="participants_count" min="0"
           @if(old('participants_count'))
               value="{{old('participants_count')}}"
           @else
               @if(isset($item))
                   value="{{$item->participants_count}}"
            @endif
            @endif
    >
    <small class="form-text text-muted">Количество команд, участвующих в турнире</small>
</div>

<div class="form-group">
    <label for="content">Контент <span class="input_counter"></span></label>
    <?php
    $content = old('content')
        ? old('content')
        : (isset($item) ? $item->content : '');
    ?>
    <textarea class="form-control" name="content" id="content">{{$content}}</textarea>
</div>

<div class="form-group">
    <label for="status">Статус</label>
    <select class="form-control" name="status" id="status">
        <option value="1" @if((old('status') === '1' || old('status') === 1) || (isset($item) && $item->status == 1)) selected @endif>Активен</option>
        <option value="0" @if((old('status') === '0' || old('status') === 0) || (isset($item) && $item->status == 0)) selected @endif>Неактивен</option>
    </select>
</div>

<script src="/admin-assets/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="/admin-assets/tinymce/wysiwyg.js"></script>
<script>
    tInit('#content');
    
    // Синхронизация color picker с текстовым полем
    document.getElementById('color').addEventListener('input', function(e) {
        const value = e.target.value;
        if (/^#[0-9A-Fa-f]{6}$/.test(value)) {
            document.getElementById('colorPicker').value = value;
        }
    });
    
    document.getElementById('colorPicker').addEventListener('change', function(e) {
        document.getElementById('color').value = e.target.value;
    });
</script>

