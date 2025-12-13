@include('admin.includes.partials.seo-fields')

<div class="form-group">
    <label for="name"><i class="red">*</i> Название команды</label>
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
    <label for="logo">Логотип</label>
    <input type="text" class="form-control" name="logo" id="logo"
           @if(old('logo'))
               value="{{old('logo')}}"
           @else
               @if(isset($item))
                   value="{{$item->logo}}"
            @endif
            @endif
    >
</div>

<div class="row">
    <div class="col-md-6">
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
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="city_id">ID города</label>
            <input type="number" class="form-control" name="city_id" id="city_id"
                   @if(old('city_id'))
                       value="{{old('city_id')}}"
                   @else
                       @if(isset($item))
                           value="{{$item->city_id}}"
                    @endif
                    @endif
            >
        </div>
    </div>
</div>

<div class="form-group">
    <label for="stadium">Стадион</label>
    <input type="text" class="form-control" name="stadium" id="stadium"
           @if(old('stadium'))
               value="{{old('stadium')}}"
           @else
               @if(isset($item))
                   value="{{$item->stadium}}"
            @endif
            @endif
    >
</div>

<div class="form-group">
    <label for="stadium_info">Информация о стадионе</label>
    <textarea class="form-control" name="stadium_info" id="stadium_info" rows="3">{{old('stadium_info', isset($item) ? $item->stadium_info : '')}}</textarea>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="stadium_small_preview">Маленькое превью стадиона</label>
            <input type="text" class="form-control" name="stadium_small_preview" id="stadium_small_preview"
                   @if(old('stadium_small_preview'))
                       value="{{old('stadium_small_preview')}}"
                   @else
                       @if(isset($item))
                           value="{{$item->stadium_small_preview}}"
                    @endif
                    @endif
            >
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="stadium_big_preview">Большое превью стадиона</label>
            <input type="text" class="form-control" name="stadium_big_preview" id="stadium_big_preview"
                   @if(old('stadium_big_preview'))
                       value="{{old('stadium_big_preview')}}"
                   @else
                       @if(isset($item))
                           value="{{$item->stadium_big_preview}}"
                    @endif
                    @endif
            >
        </div>
    </div>
</div>

<div class="form-group">
    <label for="date_created">Дата создания (год)</label>
    <input type="number" class="form-control" name="date_created" id="date_created" min="1800" max="2100"
           @if(old('date_created'))
               value="{{old('date_created')}}"
           @else
               @if(isset($item))
                   value="{{$item->date_created}}"
            @endif
            @endif
    >
</div>

<div class="form-group">
    <label for="description">Описание <span class="input_counter"></span></label>
    <?php
    $description = old('description')
        ? old('description')
        : (isset($item) ? $item->description : '');
    ?>
    <textarea class="form-control" name="description" id="description">{{$description}}</textarea>
</div>

<div class="form-group">
    <label for="status">Статус</label>
    <select class="form-control" name="status" id="status">
        <option value="1" @if((old('status') === '1' || old('status') === 1) || (isset($item) && $item->status == 1)) selected @endif>Активна</option>
        <option value="0" @if((old('status') === '0' || old('status') === 0) || (isset($item) && $item->status == 0)) selected @endif>Неактивна</option>
    </select>
</div>

<script src="/admin-assets/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="/admin-assets/tinymce/wysiwyg.js"></script>
<script>
    tInit('#description');
</script>

