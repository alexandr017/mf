@include('admin.includes.partials.seo-fields')

<div class="form-group">
    <label for="alias"><i class="red">*</i> Постоянная ссылка:</label> <span class="btn btn-default btn-xs translate"><i class="fa fa-language"></i></span>
    <input type="text" class="form-control" name="alias" id="alias" required
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
    <label for="preview">Превью (путь к изображению)</label>
    <input type="text" class="form-control" name="preview" id="preview"
           @if(old('preview'))
               value="{{old('preview')}}"
           @else
               @if(isset($item))
                   value="{{$item->preview}}"
            @endif
            @endif
    >
</div>

<div class="form-group">
    <label for="short_content">Краткое описание <span class="input_counter"></span></label>
    <?php
    $short_content = old('short_content')
        ? old('short_content')
        : (isset($item) ? $item->short_content : '');
    ?>
    <textarea class="form-control" name="short_content" id="short_content" rows="3">{{$short_content}}</textarea>
</div>

<div class="form-group">
    <label for="content">Содержание <span class="input_counter"></span></label>
    <?php
    $content = old('content')
        ? old('content')
        : (isset($item) ? $item->content : '');
    ?>
    <textarea class="form-control" name="content" id="content">{{$content}}</textarea>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="published_at">Дата публикации</label>
            <input type="datetime-local" class="form-control" name="published_at" id="published_at"
                   @if(old('published_at'))
                       value="{{old('published_at')}}"
                   @else
                       @if(isset($item) && $item->published_at)
                           value="{{$item->published_at->format('Y-m-d\TH:i')}}"
                       @endif
                   @endif
            >
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="status">Статус</label>
            <select class="form-control" name="status" id="status">
                <option value="1" @if((old('status') === '1' || old('status') === 1) || (isset($item) && $item->status == 1)) selected @endif>Опубликована</option>
                <option value="0" @if((old('status') === '0' || old('status') === 0) || (isset($item) && $item->status == 0)) selected @endif>Черновик</option>
            </select>
        </div>
    </div>
</div>

<script src="/admin-assets/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="/admin-assets/tinymce/wysiwyg.js"></script>
<script>
    tInit('#content');
</script>



