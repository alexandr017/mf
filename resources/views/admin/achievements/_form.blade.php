<div class="form-group">
    <label for="name"><i class="red">*</i> Название достижения</label>
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
    <label for="description">Описание</label>
    <textarea class="form-control" name="description" id="description" rows="4">{{old('description', isset($item) ? $item->description : '')}}</textarea>
</div>

<div class="form-group">
    <label for="image">Изображение (путь к файлу)</label>
    <input type="text" class="form-control" name="image" id="image"
           @if(old('image'))
               value="{{old('image')}}"
           @else
               @if(isset($item))
                   value="{{$item->image}}"
            @endif
            @endif
    >
    @if(isset($item) && $item->image)
        <div class="mt-2">
            <img src="{{$item->image}}" alt="{{$item->name}}" style="max-width: 200px; max-height: 200px;">
        </div>
    @endif
</div>

