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
    <label for="country_id">ID страны</label>
    <input type="number" class="form-control" name="country_id" id="country_id"
           @if(old('country_id'))
               value="{{old('country_id')}}"
           @else
               @if(isset($item))
                   value="{{$item->country_id}}"
            @endif
            @endif
    >
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
</script>

