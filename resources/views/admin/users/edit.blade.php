@extends ('admin.layouts.app')
@section ('title', 'Редактирование пользователя')
@section ('h1', 'Редактирование пользователя')

@section('content')
    <form action="{{ route('admin.users.update', $item->id) }}" method="post">

        {{ method_field('PATCH') }}

        <input type="hidden" name="_token" id="key" value="{{ csrf_token() }}">

        @include('admin.users._form')

        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Сохранить</button>

    </form>

    <div class="clearfix"></div>
    <br>

    <!-- Quick Team Change -->
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Быстрая смена команды</h3>
        </div>
        <div class="box-body">
            @php
                $transferService = app(\App\Services\TeamTransferService::class);
                $currentSeason = $transferService->getCurrentSeason();
                $currentUserTeam = \App\Models\UserTeams\UserTeam::where('user_id', $item->id)
                    ->where('season', $currentSeason)
                    ->with('team')
                    ->first();
                $allTeams = \App\Models\Teams\Team::orderBy('name')->get();
            @endphp
            
            <div class="form-group">
                <label>Текущая команда</label>
                <p class="form-control-static">
                    @if($currentUserTeam && $currentUserTeam->team)
                        <strong>{{ $currentUserTeam->team->name }}</strong>
                        <span class="label label-info">Сезон {{ $currentSeason }}</span>
                    @else
                        <span class="text-muted">Не состоит в команде</span>
                    @endif
                </p>
            </div>

            <form action="{{ route('admin.users.change-team', $item->id) }}" method="post" id="changeTeamForm">
                @csrf
                <div class="form-group">
                    <label for="new_team_id">Новая команда</label>
                    <select class="form-control select2" name="team_id" id="new_team_id" style="width: 100%;" required>
                        <option value="">Выберите команду</option>
                        @foreach($allTeams as $team)
                            <option value="{{ $team->id }}" 
                                @if($currentUserTeam && $currentUserTeam->team_id == $team->id) selected @endif>
                                {{ $team->name }}
                                @php
                                    $playersCount = $transferService->getActivePlayersCount($team, $currentSeason);
                                @endphp
                                ({{ $playersCount }} / 100 игроков)
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-exchange"></i> Сменить команду
                </button>
            </form>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#new_team_id').select2({
            placeholder: 'Выберите команду',
            allowClear: true
        });
    });
    </script>
@stop





