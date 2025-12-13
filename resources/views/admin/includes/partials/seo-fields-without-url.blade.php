<div class="form-group">
    <label for="title"><i class="red">*</i> Title <span class="input_counter"></span></label>
    <input type="text" class="form-control" name="title" id="title" required
           @if(old('title'))
    value="{{old('title')}}"
    @else
    @if(isset($item))
    value="{{$item->title}}"
    @endif
    @endif
    >
</div>

<div class="form-group">
    <label for="meta_description"><i class="red">*</i> Мета описание <span class="input_counter"></span></label>
    <?php
    $meta_description = old('meta_description')
        ? old('meta_description')
        : (isset($item) ? $item->meta_description : '');
    ?>
    <textarea class="form-control" name="meta_description" id="meta_description" required>{{$meta_description}}</textarea>
</div>

<div class="form-group">
    <label for="h1"><i class="red">*</i> h1 <span class="input_counter"></span></label>
    <input type="text" class="form-control" name="h1" id="h1" required
           @if(old('h1'))
    value="{{old('h1')}}"
    @else
    @if(isset($item))
    value="{{$item->h1}}"
    @endif
    @endif
    >
</div>

<div class="form-group">
    <label for="breadcrumbs">Хлебные крошки <span class="input_counter"></span></label>
    <?php
    $breadcrumbs = old('breadcrumbs')
        ? old('breadcrumbs')
        : (isset($item) ? $item->breadcrumbs : '');
    ?>
    <textarea class="form-control" name="breadcrumbs" id="breadcrumbs">{{$breadcrumbs}}</textarea>
</div>
