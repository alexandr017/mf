<div class="form-group">
    <label for="country_id"><i class="red">*</i> Страна</label>
    <select class="form-control" name="country_id" id="country_id" required>
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

<div class="form-group">
    <label for="name"><i class="red">*</i> Название города</label>
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

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="ip">IP</label>
            <input type="text" class="form-control" name="ip" id="ip"
                   @if(old('ip'))
                       value="{{old('ip')}}"
                   @else
                       @if(isset($item))
                           value="{{$item->ip}}"
                    @endif
                    @endif
            >
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="rp">RP</label>
            <input type="text" class="form-control" name="rp" id="rp"
                   @if(old('rp'))
                       value="{{old('rp')}}"
                   @else
                       @if(isset($item))
                           value="{{$item->rp}}"
                    @endif
                    @endif
            >
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="dp">DP</label>
            <input type="text" class="form-control" name="dp" id="dp"
                   @if(old('dp'))
                       value="{{old('dp')}}"
                   @else
                       @if(isset($item))
                           value="{{$item->dp}}"
                    @endif
                    @endif
            >
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="vp">VP</label>
            <input type="text" class="form-control" name="vp" id="vp"
                   @if(old('vp'))
                       value="{{old('vp')}}"
                   @else
                       @if(isset($item))
                           value="{{$item->vp}}"
                    @endif
                    @endif
            >
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="tp">TP</label>
            <input type="text" class="form-control" name="tp" id="tp"
                   @if(old('tp'))
                       value="{{old('tp')}}"
                   @else
                       @if(isset($item))
                           value="{{$item->tp}}"
                    @endif
                    @endif
            >
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="mp">MP</label>
            <input type="text" class="form-control" name="mp" id="mp"
                   @if(old('mp'))
                       value="{{old('mp')}}"
                   @else
                       @if(isset($item))
                           value="{{$item->mp}}"
                    @endif
                    @endif
            >
        </div>
    </div>
</div>


