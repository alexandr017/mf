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
    <label for="name"><i class="red">*</i> Название команды</label>
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
    <label for="alias">Постоянная ссылка:</label> <span class="btn btn-default btn-xs translate"><i class="fa fa-language"></i></span>
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
    <label for="logo">Логотип</label>
    <input type="text" class="form-control" name="logo" id="logo"
           @if(old('logo'))
               value="{{old('logo')}}"
           @else
               @if(isset($item))
                   value="{{$item->logo}}"
            @endif
            @endif
    >
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="country_id">Страна</label>
            <select class="form-control" name="country_id" id="country_id">
                <option value="">Выберите страну</option>
                @foreach($countries as $country)
                    <option value="{{$country->id}}"
                            @if((old('country_id') == $country->id) || (isset($item) && $item->country_id == $country->id))
                                selected
                            @endif>
                        {{$country->name}}@if($country->code) ({{$country->code}})@endif
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="city_id">Город</label>
            <select class="form-control" name="city_id" id="city_id">
                <option value="">Выберите город</option>
                @if(isset($cities) && $cities->isNotEmpty())
                    @foreach($cities as $city)
                        <option value="{{$city->id}}"
                                @if((old('city_id') == $city->id) || (isset($item) && $item->city_id == $city->id))
                                    selected
                                @endif>
                            {{$city->name}}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="stadium">Стадион</label>
    <input type="text" class="form-control" name="stadium" id="stadium"
           @if(old('stadium'))
               value="{{old('stadium')}}"
           @else
               @if(isset($item))
                   value="{{$item->stadium}}"
            @endif
            @endif
    >
</div>

<div class="form-group">
    <label for="stadium_info">Информация о стадионе</label>
    <textarea class="form-control" name="stadium_info" id="stadium_info" rows="3">{{old('stadium_info', isset($item) ? $item->stadium_info : '')}}</textarea>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="stadium_small_preview">Маленькое превью стадиона</label>
            <input type="text" class="form-control" name="stadium_small_preview" id="stadium_small_preview"
                   @if(old('stadium_small_preview'))
                       value="{{old('stadium_small_preview')}}"
                   @else
                       @if(isset($item))
                           value="{{$item->stadium_small_preview}}"
                    @endif
                    @endif
            >
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="stadium_big_preview">Большое превью стадиона</label>
            <input type="text" class="form-control" name="stadium_big_preview" id="stadium_big_preview"
                   @if(old('stadium_big_preview'))
                       value="{{old('stadium_big_preview')}}"
                   @else
                       @if(isset($item))
                           value="{{$item->stadium_big_preview}}"
                    @endif
                    @endif
            >
        </div>
    </div>
</div>

<div class="form-group">
    <label for="date_created">Дата создания (год)</label>
    <input type="number" class="form-control" name="date_created" id="date_created" min="1800" max="2100"
           @if(old('date_created'))
               value="{{old('date_created')}}"
           @else
               @if(isset($item))
                   value="{{$item->date_created}}"
            @endif
            @endif
    >
</div>

<div class="form-group">
    <label for="description">Описание <span class="input_counter"></span></label>
    <?php
    $description = old('description')
        ? old('description')
        : (isset($item) ? $item->description : '');
    ?>
    <textarea class="form-control" name="description" id="description">{{$description}}</textarea>
</div>

<div class="form-group">
    <label for="status">Статус</label>
    <select class="form-control" name="status" id="status">
        <option value="1" @if((old('status') === '1' || old('status') === 1) || (isset($item) && $item->status == 1)) selected @endif>Активна</option>
        <option value="0" @if((old('status') === '0' || old('status') === 0) || (isset($item) && $item->status == 0)) selected @endif>Неактивна</option>
    </select>
</div>

<script src="/admin-assets/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="/admin-assets/tinymce/wysiwyg.js"></script>
<script>
    tInit('#description');

    // Динамическая загрузка городов при выборе страны
    document.addEventListener('DOMContentLoaded', function() {
        const countrySelect = document.getElementById('country_id');
        const citySelect = document.getElementById('city_id');
        const selectedCityId = @json(old('city_id', isset($item) && $item->city_id ? $item->city_id : null));

        if (countrySelect && citySelect) {
            countrySelect.addEventListener('change', function() {
                const countryId = this.value;
                citySelect.innerHTML = '<option value="">Загрузка...</option>';
                citySelect.disabled = true;

                if (!countryId) {
                    citySelect.innerHTML = '<option value="">Выберите город</option>';
                    citySelect.disabled = false;
                    return;
                }

                fetch('{{ route("admin.teams.cities-by-country") }}?country_id=' + countryId, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    citySelect.innerHTML = '<option value="">Выберите город</option>';

                    data.forEach(function(city) {
                        const option = document.createElement('option');
                        option.value = city.id;
                        option.textContent = city.name;
                        // Сохраняем выбранный город (приоритет у old(), затем у текущего значения)
                        const currentCityId = @json(old('city_id', isset($item) && $item->city_id ? $item->city_id : null));
                        if (currentCityId && city.id == currentCityId) {
                            option.selected = true;
                        }
                        citySelect.appendChild(option);
                    });

                    citySelect.disabled = false;
                })
                .catch(error => {
                    console.error('Ошибка загрузки городов:', error);
                    citySelect.innerHTML = '<option value="">Ошибка загрузки</option>';
                    citySelect.disabled = false;
                });
            });

            // Если страна уже выбрана при загрузке страницы, загружаем города
            if (countrySelect.value) {
                countrySelect.dispatchEvent(new Event('change'));
            }
        }
    });
</script>


