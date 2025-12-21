<div class="form-group">
    <label for="name"><i class="red">*</i> Название</label>
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
    <label for="alias"><i class="red">*</i> Алиас</label>
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
    <label for="description">Описание</label>
    <?php
    $description = old('description')
        ? old('description')
        : (isset($item) ? $item->description : '');
    ?>
    <textarea class="form-control" name="description" id="description" rows="3">{{$description}}</textarea>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="order">Порядок</label>
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
    <div class="col-md-6">
        <div class="form-group">
            <label for="status">Статус</label>
            <select class="form-control" name="status" id="status">
                <option value="1" @if((old('status') === '1' || old('status') === 1) || (isset($item) && $item->status == 1)) selected @endif>Активна</option>
                <option value="0" @if((old('status') === '0' || old('status') === 0) || (isset($item) && $item->status == 0)) selected @endif>Неактивна</option>
            </select>
        </div>
    </div>
</div>



