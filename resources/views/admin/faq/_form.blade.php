<div class="form-group">
    <label for="question"><i class="red">*</i> Вопрос <span class="input_counter"></span></label>
    <?php
    $question = old('question')
        ? old('question')
        : (isset($item) ? $item->question : '');
    ?>
    <textarea class="form-control" name="question" id="question" rows="3" required>{{$question}}</textarea>
</div>

<div class="form-group">
    <label for="answer"><i class="red">*</i> Ответ <span class="input_counter"></span></label>
    <?php
    $answer = old('answer')
        ? old('answer')
        : (isset($item) ? $item->answer : '');
    ?>
    <textarea class="form-control" name="answer" id="answer">{{$answer}}</textarea>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="order">Порядок сортировки</label>
            <input type="number" class="form-control" name="order" id="order" min="0" value="0"
                   @if(old('order') !== null)
                       value="{{old('order')}}"
                   @else
                       @if(isset($item))
                           value="{{$item->order}}"
                       @endif
                   @endif
            >
            <small class="form-text text-muted">Чем меньше число, тем выше в списке</small>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="status">Статус</label>
            <select class="form-control" name="status" id="status">
                <option value="1" @if((old('status') === '1' || old('status') === 1) || (isset($item) && $item->status == 1)) selected @endif>Активен</option>
                <option value="0" @if((old('status') === '0' || old('status') === 0) || (isset($item) && $item->status == 0)) selected @endif>Неактивен</option>
            </select>
        </div>
    </div>
</div>

<script src="/admin-assets/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="/admin-assets/tinymce/wysiwyg.js"></script>
<script>
    tInit('#answer');
</script>




