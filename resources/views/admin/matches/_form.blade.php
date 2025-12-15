<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="tournament_id">Турнир</label>
            <select class="form-control" name="tournament_id" id="tournament_id">
                <option value="">Выберите турнир</option>
                @foreach($tournaments as $tournament)
                    <option value="{{$tournament->id}}"
                            @if((old('tournament_id') == $tournament->id) || (isset($tournamentId) && $tournamentId == $tournament->id) || (isset($item) && $item->stage && $item->stage->season && $item->stage->season->tournament_id == $tournament->id))
                                selected
                            @endif>
                        {{$tournament->name}}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="season_id">Сезон</label>
            <select class="form-control" name="season_id" id="season_id">
                <option value="">Выберите сезон</option>
                @foreach($seasons as $season)
                    <option value="{{$season->id}}"
                            @if((old('season_id') == $season->id) || (isset($seasonId) && $seasonId == $season->id) || (isset($item) && $item->stage && $item->stage->tournaments_season_id == $season->id))
                                selected
                            @endif>
                        {{$season->year_start}}/{{$season->year_finish}}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="stage_id"><i class="red">*</i> Стадия</label>
            <select class="form-control" name="stage_id" id="stage_id" required>
                <option value="">Выберите стадию</option>
                @foreach($stages as $stage)
                    <option value="{{$stage->id}}"
                            @if((old('stage_id') == $stage->id) || (isset($item) && $item->stage_id == $stage->id))
                                selected
                            @endif>
                        {{$stage->name}} ({{$stage->type}})
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="group_id">Группа</label>
            <select class="form-control" name="group_id" id="group_id">
                <option value="">Без группы</option>
                @if(isset($groups) && $groups->isNotEmpty())
                    @foreach($groups as $group)
                        <option value="{{$group->id}}"
                                @if((old('group_id') == $group->id) || (isset($item) && $item->group_id == $group->id))
                                    selected
                                @endif>
                            {{$group->name}}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="team_1">Команда 1 (хозяева)</label>
            <select class="form-control" name="team_1" id="team_1">
                <option value="">Не выбрана</option>
                @foreach($teams as $team)
                    <option value="{{$team->id}}"
                            @if((old('team_1') == $team->id) || (isset($item) && $item->team_1 == $team->id))
                                selected
                            @endif>
                        {{$team->name}}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="team_2">Команда 2 (гости)</label>
            <select class="form-control" name="team_2" id="team_2">
                <option value="">Не выбрана</option>
                @foreach($teams as $team)
                    <option value="{{$team->id}}"
                            @if((old('team_2') == $team->id) || (isset($item) && $item->team_2 == $team->id))
                                selected
                            @endif>
                        {{$team->name}}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="date">Дата и время матча</label>
            <input type="datetime-local" class="form-control" name="date" id="date"
                   @if(old('date'))
                       value="{{old('date')}}"
                   @else
                       @if(isset($item) && $item->date)
                           value="{{$item->date->format('Y-m-d\TH:i')}}"
                    @endif
                    @endif
            >
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="stadium_id">Стадион</label>
            <select class="form-control" name="stadium_id" id="stadium_id">
                <option value="">Не выбран</option>
                @foreach($teams as $team)
                    <option value="{{$team->id}}"
                            @if((old('stadium_id') == $team->id) || (isset($item) && $item->stadium_id == $team->id))
                                selected
                            @endif>
                        {{$team->name}} - {{$team->stadium}}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="score_1">Счет команды 1</label>
            <input type="number" class="form-control" name="score_1" id="score_1" min="0" max="255"
                   @if(old('score_1') !== null)
                       value="{{old('score_1')}}"
                   @else
                       @if(isset($item))
                           value="{{$item->score_1}}"
                    @endif
                    @endif
            >
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="score_2">Счет команды 2</label>
            <input type="number" class="form-control" name="score_2" id="score_2" min="0" max="255"
                   @if(old('score_2') !== null)
                       value="{{old('score_2')}}"
                   @else
                       @if(isset($item))
                           value="{{$item->score_2}}"
                    @endif
                    @endif
            >
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="pen_1">Пенальти команды 1</label>
            <input type="number" class="form-control" name="pen_1" id="pen_1" min="0" max="255"
                   @if(old('pen_1') !== null)
                       value="{{old('pen_1')}}"
                   @else
                       @if(isset($item))
                           value="{{$item->pen_1}}"
                    @endif
                    @endif
            >
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="pen_2">Пенальти команды 2</label>
            <input type="number" class="form-control" name="pen_2" id="pen_2" min="0" max="255"
                   @if(old('pen_2') !== null)
                       value="{{old('pen_2')}}"
                   @else
                       @if(isset($item))
                           value="{{$item->pen_2}}"
                    @endif
                    @endif
            >
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="status"><i class="red">*</i> Статус</label>
            <select class="form-control" name="status" id="status" required>
                <option value="scheduled" @if((old('status') == 'scheduled') || (isset($item) && $item->status == 'scheduled')) selected @endif>Запланирован</option>
                <option value="played" @if((old('status') == 'played') || (isset($item) && $item->status == 'played')) selected @endif>Сыгран</option>
                <option value="cancelled" @if((old('status') == 'cancelled') || (isset($item) && $item->status == 'cancelled')) selected @endif>Отменен</option>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="referee">Судья</label>
            <input type="text" class="form-control" name="referee" id="referee"
                   @if(old('referee'))
                       value="{{old('referee')}}"
                   @else
                       @if(isset($item))
                           value="{{$item->referee}}"
                    @endif
                    @endif
            >
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="attendance">Посещаемость</label>
            <input type="number" class="form-control" name="attendance" id="attendance" min="0"
                   @if(old('attendance') !== null)
                       value="{{old('attendance')}}"
                   @else
                       @if(isset($item))
                           value="{{$item->attendance}}"
                    @endif
                    @endif
            >
        </div>
    </div>
</div>

<div class="form-group">
    <label for="description">Описание матча</label>
    <?php
    $description = old('description')
        ? old('description')
        : (isset($item) ? $item->description : '');
    ?>
    <textarea class="form-control" name="description" id="description" rows="3">{{$description}}</textarea>
</div>

<div class="form-group">
    <label for="video_url">Ссылка на видео</label>
    <input type="url" class="form-control" name="video_url" id="video_url"
           @if(old('video_url'))
               value="{{old('video_url')}}"
           @else
               @if(isset($item))
                   value="{{$item->video_url}}"
            @endif
            @endif
    >
</div>

<div class="form-group">
    <label for="match_report">Отчет о матче</label>
    <?php
    $matchReport = old('match_report')
        ? old('match_report')
        : (isset($item) ? $item->match_report : '');
    ?>
    <textarea class="form-control" name="match_report" id="match_report" rows="5">{{$matchReport}}</textarea>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tournamentSelect = document.getElementById('tournament_id');
    const seasonSelect = document.getElementById('season_id');
    const stageSelect = document.getElementById('stage_id');
    const groupSelect = document.getElementById('group_id');

    // Загрузка сезонов по турниру
    if (tournamentSelect) {
        tournamentSelect.addEventListener('change', function() {
            const tournamentId = this.value;
            seasonSelect.innerHTML = '<option value="">Загрузка...</option>';
            seasonSelect.disabled = true;

            if (!tournamentId) {
                seasonSelect.innerHTML = '<option value="">Выберите сезон</option>';
                seasonSelect.disabled = false;
                stageSelect.innerHTML = '<option value="">Выберите стадию</option>';
                groupSelect.innerHTML = '<option value="">Без группы</option>';
                return;
            }

            fetch('{{ route("admin.matches.seasons-by-tournament") }}?tournament_id=' + tournamentId, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                seasonSelect.innerHTML = '<option value="">Выберите сезон</option>';
                data.forEach(function(season) {
                    const option = document.createElement('option');
                    option.value = season.id;
                    option.textContent = season.year_start + '/' + season.year_finish;
                    seasonSelect.appendChild(option);
                });
                seasonSelect.disabled = false;
                
                // Сбрасываем стадии и группы
                stageSelect.innerHTML = '<option value="">Выберите стадию</option>';
                groupSelect.innerHTML = '<option value="">Без группы</option>';
            })
            .catch(error => {
                console.error('Ошибка загрузки сезонов:', error);
                seasonSelect.innerHTML = '<option value="">Ошибка загрузки</option>';
                seasonSelect.disabled = false;
            });
        });
    }

    // Загрузка стадий по сезону
    if (seasonSelect) {
        seasonSelect.addEventListener('change', function() {
            const seasonId = this.value;
            stageSelect.innerHTML = '<option value="">Загрузка...</option>';
            stageSelect.disabled = true;

            if (!seasonId) {
                stageSelect.innerHTML = '<option value="">Выберите стадию</option>';
                stageSelect.disabled = false;
                groupSelect.innerHTML = '<option value="">Без группы</option>';
                return;
            }

            fetch('{{ route("admin.matches.stages-by-season") }}?season_id=' + seasonId, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                stageSelect.innerHTML = '<option value="">Выберите стадию</option>';
                data.forEach(function(stage) {
                    const option = document.createElement('option');
                    option.value = stage.id;
                    option.textContent = stage.name + ' (' + stage.type + ')';
                    stageSelect.appendChild(option);
                });
                stageSelect.disabled = false;
                
                // Сбрасываем группы
                groupSelect.innerHTML = '<option value="">Без группы</option>';
            })
            .catch(error => {
                console.error('Ошибка загрузки стадий:', error);
                stageSelect.innerHTML = '<option value="">Ошибка загрузки</option>';
                stageSelect.disabled = false;
            });
        });
    }

    // Загрузка групп по стадии
    if (stageSelect) {
        stageSelect.addEventListener('change', function() {
            const stageId = this.value;
            groupSelect.innerHTML = '<option value="">Загрузка...</option>';
            groupSelect.disabled = true;

            if (!stageId) {
                groupSelect.innerHTML = '<option value="">Без группы</option>';
                groupSelect.disabled = false;
                return;
            }

            fetch('{{ route("admin.matches.groups-by-stage") }}?stage_id=' + stageId, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                groupSelect.innerHTML = '<option value="">Без группы</option>';
                data.forEach(function(group) {
                    const option = document.createElement('option');
                    option.value = group.id;
                    option.textContent = group.name;
                    groupSelect.appendChild(option);
                });
                groupSelect.disabled = false;
            })
            .catch(error => {
                console.error('Ошибка загрузки групп:', error);
                groupSelect.innerHTML = '<option value="">Ошибка загрузки</option>';
                groupSelect.disabled = false;
            });
        });
    }

    // Если сезон уже выбран при загрузке страницы, загружаем стадии
    if (seasonSelect && seasonSelect.value) {
        seasonSelect.dispatchEvent(new Event('change'));
    }
    
    // Если стадия уже выбрана при загрузке страницы, загружаем группы
    if (stageSelect && stageSelect.value) {
        stageSelect.dispatchEvent(new Event('change'));
    }
});
</script>

