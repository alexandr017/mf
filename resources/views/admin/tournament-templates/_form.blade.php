<div class="form-group">
    <label for="name"><i class="red">*</i> Название шаблона</label>
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
    <label for="type"><i class="red">*</i> Тип турнира</label>
    <select class="form-control" name="type" id="type" required>
        <option value="">Выберите тип</option>
        <option value="league" @if((old('type') == 'league') || (isset($item) && $item->type == 'league')) selected @endif>Лига</option>
        <option value="cup" @if((old('type') == 'cup') || (isset($item) && $item->type == 'cup')) selected @endif>Кубок</option>
        <option value="supercup" @if((old('type') == 'supercup') || (isset($item) && $item->type == 'supercup')) selected @endif>Суперкубок</option>
        <option value="mixed" @if((old('type') == 'mixed') || (isset($item) && $item->type == 'mixed')) selected @endif>Смешанный</option>
    </select>
</div>

<div class="form-group">
    <label for="description">Описание</label>
    <textarea class="form-control" name="description" id="description" rows="3">{{old('description', isset($item) ? $item->description : '')}}</textarea>
</div>

<!-- Скрытые поля для JSON (заполняются автоматически) -->
<input type="hidden" name="structure_json" id="structure_json" required>
<input type="hidden" name="config_json" id="config_json" required>

<!-- UI для структуры турнира -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Структура турнира (Стадии)</h3>
    </div>
    <div class="panel-body">
        <div id="stages-container">
            <!-- Стадии будут добавлены через JS -->
        </div>
        <button type="button" class="btn btn-sm btn-success" id="add-stage-btn">
            <i class="fa fa-plus"></i> Добавить стадию
        </button>
    </div>
</div>

<!-- UI для конфигурации -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Конфигурация генерации</h3>
    </div>
    <div class="panel-body" id="config-container">
        <!-- Конфигурация будет добавлена через JS в зависимости от типа -->
    </div>
</div>

<div class="form-group">
    <label for="is_default">По умолчанию</label>
    <select class="form-control" name="is_default" id="is_default">
        <option value="0" @if((old('is_default') === '0' || old('is_default') === 0) || (isset($item) && !$item->is_default)) selected @endif>Нет</option>
        <option value="1" @if((old('is_default') === '1' || old('is_default') === 1) || (isset($item) && $item->is_default)) selected @endif>Да</option>
    </select>
</div>

<script>
(function() {
    // Инициализация данных
    let stages = [];
    let config = {};
    
    @if(isset($item))
        stages = @json($item->structure_json['stages'] ?? []);
        @if($item->config_json)
            config = @json($item->config_json);
        @else
            config = {};
        @endif
    @elseif(old('structure_json'))
        try {
            const oldStructure = JSON.parse(@json(old('structure_json')));
            stages = oldStructure.stages || [];
        } catch(e) {
            stages = [];
        }
        try {
            const oldConfig = JSON.parse(@json(old('config_json')));
            config = oldConfig || {};
        } catch(e) {
            config = {};
        }
    @endif

    const typeSelect = document.getElementById('type');
    const stagesContainer = document.getElementById('stages-container');
    const configContainer = document.getElementById('config-container');
    const addStageBtn = document.getElementById('add-stage-btn');
    const structureJsonInput = document.getElementById('structure_json');
    const configJsonInput = document.getElementById('config_json');

    // Типы стадий
    const stageTypes = {
        'league_round': 'Круг лиги',
        'cup_round': 'Раунд кубка',
        'group_stage': 'Групповая стадия',
        'playoff': 'Плей-офф',
        'final': 'Финал'
    };

    // Рендеринг стадий
    function renderStages() {
        stagesContainer.innerHTML = '';
        stages.forEach((stage, index) => {
            const stageDiv = document.createElement('div');
            stageDiv.className = 'panel panel-info stage-item';
            stageDiv.dataset.index = index;
            stageDiv.innerHTML = `
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-10">
                            <strong>Стадия ${index + 1}</strong>
                        </div>
                        <div class="col-md-2 text-right">
                            <button type="button" class="btn btn-xs btn-danger remove-stage" data-index="${index}">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Название стадии</label>
                                <input type="text" class="form-control stage-name" value="${stage.name || ''}" data-index="${index}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Тип стадии</label>
                                <select class="form-control stage-type" data-index="${index}">
                                    ${Object.entries(stageTypes).map(([value, label]) => 
                                        `<option value="${value}" ${stage.type === value ? 'selected' : ''}>${label}</option>`
                                    ).join('')}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Порядок</label>
                                <input type="number" class="form-control stage-order" value="${stage.order || index + 1}" min="1" data-index="${index}">
                            </div>
                        </div>
                    </div>
                </div>
            `;
            stagesContainer.appendChild(stageDiv);
        });

        // Добавляем обработчики событий
        document.querySelectorAll('.stage-name, .stage-type, .stage-order').forEach(input => {
            input.addEventListener('change', updateStage);
        });

        document.querySelectorAll('.remove-stage').forEach(btn => {
            btn.addEventListener('click', function() {
                const index = parseInt(this.dataset.index);
                stages.splice(index, 1);
                renderStages();
                updateStructureJson();
            });
        });

        updateStructureJson();
    }

    // Обновление стадии
    function updateStage(e) {
        const index = parseInt(e.target.dataset.index);
        if (!stages[index]) {
            stages[index] = {};
        }
        
        if (e.target.classList.contains('stage-name')) {
            stages[index].name = e.target.value;
        } else if (e.target.classList.contains('stage-type')) {
            stages[index].type = e.target.value;
        } else if (e.target.classList.contains('stage-order')) {
            stages[index].order = parseInt(e.target.value) || index + 1;
        }
        
        updateStructureJson();
    }

    // Добавление новой стадии
    addStageBtn.addEventListener('click', function() {
        const newStage = {
            name: 'Новая стадия',
            type: 'league_round',
            order: stages.length + 1
        };
        stages.push(newStage);
        renderStages();
    });

    // Обновление JSON структуры
    function updateStructureJson() {
        // Сортируем по порядку
        stages.sort((a, b) => (a.order || 0) - (b.order || 0));
        structureJsonInput.value = JSON.stringify({ stages: stages });
    }

    // Рендеринг конфигурации в зависимости от типа
    function renderConfig() {
        const type = typeSelect.value;
        configContainer.innerHTML = '';

        if (!type) {
            configContainer.innerHTML = '<p class="text-muted">Выберите тип турнира для настройки конфигурации</p>';
            return;
        }

        let configHtml = '';

        switch(type) {
            case 'league':
                configHtml = `
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Количество команд</label>
                                <input type="number" class="form-control config-input" id="config-teams" 
                                       value="${config.teams || 20}" min="2">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Количество кругов</label>
                                <input type="number" class="form-control config-input" id="config-rounds" 
                                       value="${config.rounds || 2}" min="1">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Дней между кругами</label>
                                <input type="number" class="form-control config-input" id="config-days-between-rounds" 
                                       value="${config.days_between_rounds || 7}" min="1">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Дней между матчами</label>
                                <input type="number" class="form-control config-input" id="config-days-between-matches" 
                                       value="${config.days_between_matches || 1}" min="1">
                            </div>
                        </div>
                    </div>
                `;
                break;

            case 'cup':
                configHtml = `
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Количество команд</label>
                                <input type="number" class="form-control config-input" id="config-teams" 
                                       value="${config.teams || 16}" min="2">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Дней между раундами</label>
                                <input type="number" class="form-control config-input" id="config-days-between-rounds" 
                                       value="${config.days_between_rounds || 7}" min="1">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Дней между матчами</label>
                                <input type="number" class="form-control config-input" id="config-days-between-matches" 
                                       value="${config.days_between_matches || 1}" min="1">
                            </div>
                        </div>
                    </div>
                `;
                break;

            case 'supercup':
                configHtml = `
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Количество команд (должно быть 2)</label>
                                <input type="number" class="form-control config-input" id="config-teams" 
                                       value="${config.teams || 2}" min="2" max="2" readonly>
                            </div>
                        </div>
                    </div>
                `;
                break;

            case 'mixed':
                configHtml = `
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Количество команд</label>
                                <input type="number" class="form-control config-input" id="config-teams" 
                                       value="${config.teams || 32}" min="2">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Количество групп</label>
                                <input type="number" class="form-control config-input" id="config-groups" 
                                       value="${config.groups || 8}" min="2">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Размер группы</label>
                                <input type="number" class="form-control config-input" id="config-group-size" 
                                       value="${config.group_size || 4}" min="2">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Кругов в группе</label>
                                <input type="number" class="form-control config-input" id="config-group-rounds" 
                                       value="${config.group_rounds || 2}" min="1">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Дней между раундами</label>
                                <input type="number" class="form-control config-input" id="config-days-between-rounds" 
                                       value="${config.days_between_rounds || 7}" min="1">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Дней между матчами</label>
                                <input type="number" class="form-control config-input" id="config-days-between-matches" 
                                       value="${config.days_between_matches || 1}" min="1">
                            </div>
                        </div>
                    </div>
                `;
                break;
        }

        configContainer.innerHTML = configHtml;

        // Добавляем обработчики для полей конфигурации
        document.querySelectorAll('.config-input').forEach(input => {
            input.addEventListener('change', updateConfig);
            input.addEventListener('input', updateConfig);
        });

        updateConfigJson();
    }

    // Обновление конфигурации
    function updateConfig() {
        const type = typeSelect.value;
        config = {};

        switch(type) {
            case 'league':
                config.teams = parseInt(document.getElementById('config-teams')?.value) || 20;
                config.rounds = parseInt(document.getElementById('config-rounds')?.value) || 2;
                config.days_between_rounds = parseInt(document.getElementById('config-days-between-rounds')?.value) || 7;
                config.days_between_matches = parseInt(document.getElementById('config-days-between-matches')?.value) || 1;
                break;

            case 'cup':
                config.teams = parseInt(document.getElementById('config-teams')?.value) || 16;
                config.days_between_rounds = parseInt(document.getElementById('config-days-between-rounds')?.value) || 7;
                config.days_between_matches = parseInt(document.getElementById('config-days-between-matches')?.value) || 1;
                break;

            case 'supercup':
                config.teams = 2;
                break;

            case 'mixed':
                config.teams = parseInt(document.getElementById('config-teams')?.value) || 32;
                config.groups = parseInt(document.getElementById('config-groups')?.value) || 8;
                config.group_size = parseInt(document.getElementById('config-group-size')?.value) || 4;
                config.group_rounds = parseInt(document.getElementById('config-group-rounds')?.value) || 2;
                config.days_between_rounds = parseInt(document.getElementById('config-days-between-rounds')?.value) || 7;
                config.days_between_matches = parseInt(document.getElementById('config-days-between-matches')?.value) || 1;
                break;
        }

        updateConfigJson();
    }

    // Обновление JSON конфигурации
    function updateConfigJson() {
        configJsonInput.value = JSON.stringify(config);
    }

    // Обработчик изменения типа турнира
    typeSelect.addEventListener('change', function() {
        renderConfig();
        // Предустановка стадий для разных типов
        if (stages.length === 0) {
            presetStagesForType(this.value);
        }
    });

    // Предустановка стадий в зависимости от типа
    function presetStagesForType(type) {
        stages = [];
        
        switch(type) {
            case 'league':
                stages = [
                    { name: 'Круг 1', type: 'league_round', order: 1 },
                    { name: 'Круг 2', type: 'league_round', order: 2 }
                ];
                break;
            case 'cup':
                stages = [
                    { name: '1/16 финала', type: 'cup_round', order: 1 },
                    { name: '1/8 финала', type: 'cup_round', order: 2 },
                    { name: '1/4 финала', type: 'cup_round', order: 3 },
                    { name: '1/2 финала', type: 'cup_round', order: 4 },
                    { name: 'Финал', type: 'final', order: 5 }
                ];
                break;
            case 'supercup':
                stages = [
                    { name: 'Финал', type: 'final', order: 1 }
                ];
                break;
            case 'mixed':
                stages = [
                    { name: 'Групповая стадия', type: 'group_stage', order: 1 },
                    { name: '1/8 финала', type: 'playoff', order: 2 },
                    { name: '1/4 финала', type: 'playoff', order: 3 },
                    { name: '1/2 финала', type: 'playoff', order: 4 },
                    { name: 'Финал', type: 'final', order: 5 }
                ];
                break;
        }
        
        renderStages();
    }

    // Инициализация при загрузке
    document.addEventListener('DOMContentLoaded', function() {
        const currentType = typeSelect.value;
        if (currentType) {
            renderConfig();
        }
        if (stages.length > 0) {
            renderStages();
        } else if (currentType) {
            presetStagesForType(currentType);
        }
    });

    // Обновление JSON перед отправкой формы
    document.querySelector('form').addEventListener('submit', function(e) {
        updateStructureJson();
        updateConfigJson();
        
        // Валидация
        if (stages.length === 0) {
            e.preventDefault();
            alert('Добавьте хотя бы одну стадию!');
            return false;
        }
    });
})();
</script>

<style>
.stage-item {
    margin-bottom: 15px;
}
.stage-item .panel-heading {
    padding: 8px 15px;
}
.config-input {
    width: 100%;
}
</style>
