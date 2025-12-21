<div class="form-group">
    <label for="tournament_id"><i class="red">*</i> Турнир</label>
    <select class="form-control" name="tournament_id" id="tournament_id" required>
        <option value="">Выберите турнир</option>
        @foreach($tournaments as $tournament)
            <option value="{{$tournament->id}}"
                    @if((old('tournament_id') == $tournament->id) || (isset($item) && $item->tournament_id == $tournament->id) || (isset($tournamentId) && $tournamentId == $tournament->id))
                        selected
                    @endif
                    data-template="{{$tournament->template ? $tournament->template->id : ''}}"
                    data-template-type="{{$tournament->template ? $tournament->template->type : ''}}">
                {{$tournament->name}} @if($tournament->template) ({{$tournament->template->name}}) @endif
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="year_start"><i class="red">*</i> Год начала</label>
    <input type="number" class="form-control" name="year_start" id="year_start" required min="2000" max="2100"
           @if(old('year_start'))
               value="{{old('year_start')}}"
           @else
               @if(isset($item))
                   value="{{$item->year_start}}"
               @else
                   value="{{date('Y')}}"
               @endif
           @endif
    >
</div>

<div class="form-group">
    <label for="year_finish"><i class="red">*</i> Год окончания</label>
    <input type="number" class="form-control" name="year_finish" id="year_finish" required min="2000" max="2100"
           @if(old('year_finish'))
               value="{{old('year_finish')}}"
           @else
               @if(isset($item))
                   value="{{$item->year_finish}}"
               @else
                   value="{{date('Y') + 1}}"
               @endif
           @endif
    >
</div>

<div class="form-group">
    <label for="status">Статус</label>
    <select class="form-control" name="status" id="status">
        <option value="1" @if((old('status') === '1' || old('status') === 1) || (isset($item) && $item->status == 1)) selected @endif>Активен</option>
        <option value="0" @if((old('status') === '0' || old('status') === 0) || (isset($item) && $item->status == 0)) selected @endif>Неактивен</option>
    </select>
</div>

@if(!isset($item))
<div class="panel panel-default" id="generationPanel">
    <div class="panel-heading">
        <h3 class="panel-title">Генерация матчей</h3>
    </div>
    <div class="panel-body">
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="generate_matches" id="generate_matches" value="1" checked>
                    Генерировать матчи автоматически при создании сезона
                </label>
            </div>
        </div>

        <div id="generationOptions" style="display: none;">
            <div class="form-group">
                <label for="start_date">Дата начала турнира</label>
                <input type="date" class="form-control" name="start_date" id="start_date"
                       value="{{old('start_date', date('Y-m-d'))}}">
            </div>

            <div class="form-group">
                <label for="teams">Команды-участники</label>
                <select class="form-control" name="teams[]" id="teams" multiple size="10">
                    @foreach($teams as $team)
                        <option value="{{$team->id}}">{{$team->name}}</option>
                    @endforeach
                </select>
                <small class="form-text text-muted">Выберите команды для участия в турнире. Удерживайте Ctrl/Cmd для множественного выбора.</small>
            </div>

            <div class="alert alert-info" id="templateInfo" style="display: none;">
                <strong>Информация о шаблоне:</strong>
                <div id="templateInfoContent"></div>
            </div>
        </div>
    </div>
</div>
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    const generateCheckbox = document.getElementById('generate_matches');
    const generationOptions = document.getElementById('generationOptions');
    const tournamentSelect = document.getElementById('tournament_id');
    const templateInfo = document.getElementById('templateInfo');
    const templateInfoContent = document.getElementById('templateInfoContent');

    if (generateCheckbox) {
        generateCheckbox.addEventListener('change', function() {
            generationOptions.style.display = this.checked ? 'block' : 'none';
        });

        // Показываем опции, если чекбокс уже отмечен
        if (generateCheckbox.checked) {
            generationOptions.style.display = 'block';
        }
    }

    if (tournamentSelect) {
        tournamentSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const templateType = selectedOption.getAttribute('data-template-type');
            const templateId = selectedOption.getAttribute('data-template');

            if (templateId && templateType) {
                templateInfo.style.display = 'block';
                const typeNames = {
                    'league': 'Лига',
                    'cup': 'Кубок',
                    'supercup': 'Суперкубок',
                    'mixed': 'Смешанный'
                };
                templateInfoContent.innerHTML = 'Тип: <strong>' + (typeNames[templateType] || templateType) + '</strong>';
            } else {
                templateInfo.style.display = 'none';
            }
        });

        // Триггерим событие при загрузке, если уже выбран турнир
        if (tournamentSelect.value) {
            tournamentSelect.dispatchEvent(new Event('change'));
        }
    }
});
</script>




