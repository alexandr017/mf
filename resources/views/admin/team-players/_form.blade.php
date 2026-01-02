<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="team_id"><i class="red">*</i> Команда</label>
            <select class="form-control" name="team_id" id="team_id" required>
                <option value="">Выберите команду</option>
                @foreach($teams as $team)
                    <option value="{{$team->id}}"
                            @if((old('team_id') == $team->id) || (isset($item) && $item->team_id == $team->id))
                                selected
                            @endif>
                        {{$team->name}}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="user_id"><i class="red">*</i> Игрок</label>
            <select class="form-control" name="user_id" id="user_id" required>
                <option value="">Выберите игрока</option>
                @foreach($users as $user)
                    <option value="{{$user->id}}"
                            @if((old('user_id') == $user->id) || (isset($item) && $item->user_id == $user->id))
                                selected
                            @endif>
                        {{$user->name}}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="season_id"><i class="red">*</i> Сезон</label>
            <select class="form-control" name="season_id" id="season_id" required>
                <option value="">Выберите сезон</option>
                @foreach($seasons as $season)
                    <option value="{{$season->id}}"
                            @if((old('season_id') == $season->id) || (isset($item) && $item->season_id == $season->id))
                                selected
                            @endif>
                        {{$season->year_start}}/{{$season->year_finish}}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>




