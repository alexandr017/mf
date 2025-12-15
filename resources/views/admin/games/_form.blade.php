<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <label for="name"><i class="red">*</i> Название игры</label>
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
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="category_id">Категория</label>
            <select class="form-control" name="category_id" id="category_id">
                <option value="">Без категории</option>
                @if(isset($categories))
                    @foreach($categories as $category)
                        <option value="{{$category->id}}"
                                @if((old('category_id') == $category->id) || (isset($item) && $item->category_id == $category->id))
                                    selected
                                @endif>
                            {{$category->name}}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="description">Описание</label>
    <?php
    $description = old('description')
        ? old('description')
        : (isset($item) ? $item->description : '');
    ?>
    <textarea class="form-control" name="description" id="description" rows="4">{{$description}}</textarea>
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
    <label for="rules">Правила игры</label>
    <?php
    $rules = old('rules')
        ? old('rules')
        : (isset($item) ? $item->rules : '');
    ?>
    <textarea class="form-control" name="rules" id="rules" rows="6">{{$rules}}</textarea>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="rating_points">Баллы рейтинга за победу</label>
            <input type="number" class="form-control" name="rating_points" id="rating_points" min="0" step="1"
                   @if(old('rating_points'))
                       value="{{old('rating_points')}}"
                   @else
                       @if(isset($item))
                           value="{{$item->rating_points ?? 0}}"
                    @else
                        value="10"
                    @endif
                    @endif
            >
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="order">Порядок отображения</label>
            <input type="number" class="form-control" name="order" id="order" min="0" step="1"
                   @if(old('order'))
                       value="{{old('order')}}"
                   @else
                       @if(isset($item))
                           value="{{$item->order ?? 0}}"
                    @else
                        value="0"
                    @endif
                    @endif
            >
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="status">Статус</label>
            <select class="form-control" name="status" id="status">
                <option value="1" @if((old('status') === '1' || old('status') === 1) || (isset($item) && $item->status == 1)) selected @endif>Активна</option>
                <option value="0" @if((old('status') === '0' || old('status') === 0) || (isset($item) && $item->status == 0)) selected @endif>Неактивна</option>
            </select>
        </div>
    </div>
</div>

