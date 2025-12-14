@include('admin.includes.partials.seo-fields')

<div class="form-group">
    <label for="alias"><i>*</i> Постоянная ссылка:</label> <span class="btn btn-default btn-xs translate"><i class="fa fa-language"></i></span>
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
    <label for="menu_content">Меню <span class="input_counter"></span></label>
    <?php
    $menuContent = old('menu_content')
        ? old('menu_content')
        : (isset($item) ? $item->menu_content : '');
    ?>
    <textarea class="form-control" name="menu_content" id="menu_content">{{$menuContent}}</textarea>
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
    <label for="average_rating">Рейтинг страницы</label>
    <input type="number" class="form-control" name="average_rating" id="average_rating" min="3.8" max="5" step="0.01"
           @if(old('average_rating'))
               value="{{old('average_rating')}}"
           @else
               @if(isset($item))
                   value="{{$item->average_rating}}"
            @endif
            @endif
    >
</div>

<div class="form-group">
    <label for="number_of_votes">Количество голосов</label>
    <input type="number" class="form-control" name="number_of_votes" id="number_of_votes" min="10" max="100000"
           @if(old('number_of_votes'))
               value="{{old('number_of_votes')}}"
           @else
               @if(isset($item))
                   value="{{$item->number_of_votes}}"
            @endif
            @endif
    >
</div>

<script src="/admin-assets/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="/admin-assets/tinymce/wysiwyg.js"></script>
<script>
    tInit('#content');
</script>

<style>
    .breadcrumb-block {
        display: none;
    }
</style>
