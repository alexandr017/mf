<div class="form-group">
    <label for="team_1_name"><i class="red">*</i> Команда 1</label>
    <input type="text" class="form-control" name="team_1_name" id="team_1_name" required
           value="{{old('team_1_name', $item->team_1_name ?? '')}}">
</div>

<div class="form-group">
    <label for="team_1_logo">Логотип команды 1 (URL или путь)</label>
    <input type="text" class="form-control" name="team_1_logo" id="team_1_logo"
           value="{{old('team_1_logo', $item->team_1_logo ?? '')}}">
</div>

<div class="form-group">
    <label for="team_2_name"><i class="red">*</i> Команда 2</label>
    <input type="text" class="form-control" name="team_2_name" id="team_2_name" required
           value="{{old('team_2_name', $item->team_2_name ?? '')}}">
</div>

<div class="form-group">
    <label for="team_2_logo">Логотип команды 2 (URL или путь)</label>
    <input type="text" class="form-control" name="team_2_logo" id="team_2_logo"
           value="{{old('team_2_logo', $item->team_2_logo ?? '')}}">
</div>

<div class="form-group">
    <label for="match_date"><i class="red">*</i> Дата и время матча</label>
    <input type="datetime-local" class="form-control" name="match_date" id="match_date" required
           value="{{old('match_date', isset($item) && $item->match_date ? $item->match_date->format('Y-m-d\TH:i') : '')}}">
</div>

<div class="form-group">
    <label for="prediction_deadline"><i class="red">*</i> Дедлайн для прогнозов</label>
    <input type="datetime-local" class="form-control" name="prediction_deadline" id="prediction_deadline" required
           value="{{old('prediction_deadline', isset($item) && $item->prediction_deadline ? $item->prediction_deadline->format('Y-m-d\TH:i') : '')}}">
    <small class="form-text text-muted">Обычно за 1 час до начала матча</small>
</div>

<div class="form-group">
    <label for="status"><i class="red">*</i> Статус</label>
    <select class="form-control" name="status" id="status" required>
        <option value="scheduled" {{old('status', $item->status ?? 'scheduled') === 'scheduled' ? 'selected' : ''}}>Запланирован</option>
        <option value="finished" {{old('status', $item->status ?? '') === 'finished' ? 'selected' : ''}}>Завершен</option>
        <option value="cancelled" {{old('status', $item->status ?? '') === 'cancelled' ? 'selected' : ''}}>Отменен</option>
    </select>
</div>

<div class="form-group">
    <label for="score_1">Счет команды 1</label>
    <input type="number" class="form-control" name="score_1" id="score_1" min="0" max="255"
           value="{{old('score_1', $item->score_1 ?? '')}}">
</div>

<div class="form-group">
    <label for="score_2">Счет команды 2</label>
    <input type="number" class="form-control" name="score_2" id="score_2" min="0" max="255"
           value="{{old('score_2', $item->score_2 ?? '')}}">
</div>

<div class="form-group">
    <label for="description">Описание</label>
    <textarea class="form-control" name="description" id="description" rows="3">{{old('description', $item->description ?? '')}}</textarea>
</div>

