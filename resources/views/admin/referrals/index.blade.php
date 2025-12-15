@extends('admin.layouts.app')
@section('title', 'Статистика рефералов')
@section('h1', 'Статистика рефералов')

@section('content')

    <!-- Статистика -->
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Всего приглашено</h3>
                </div>
                <div class="panel-body">
                    <h2>{{ $totalReferrals }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Всего рефереров</h3>
                </div>
                <div class="panel-body">
                    <h2>{{ $totalReferrers }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Среднее на реферера</h3>
                </div>
                <div class="panel-body">
                    <h2>{{ $totalReferrers > 0 ? round($totalReferrals / $totalReferrers, 2) : 0 }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Топ рефереров -->
    <div class="panel panel-default">
        <div class="panel-heading">Топ-10 рефереров</div>
        <div class="panel-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Пользователь</th>
                    <th>Реферальный код</th>
                    <th>Приглашено</th>
                </tr>
                </thead>
                <tbody>
                @foreach($topReferrers as $index => $referrer)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $referrer->name }} ({{ $referrer->email }})</td>
                        <td><code>{{ $referrer->referral_code ?? '-' }}</code></td>
                        <td><strong>{{ $referrer->referrals_count }}</strong></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Фильтры -->
    <div class="panel panel-default">
        <div class="panel-heading">Фильтры</div>
        <div class="panel-body">
            <form method="GET" action="{{ route('admin.referrals.index') }}" class="form-inline">
                <div class="form-group">
                    <label for="referrer_id">Реферер:</label>
                    <select name="referrer_id" id="referrer_id" class="form-control" style="width: 250px;">
                        <option value="">Все рефереры</option>
                        @foreach($users as $user)
                            <option value="{{$user->id}}" @if(request('referrer_id') == $user->id) selected @endif>
                                {{$user->name}} ({{$user->email}})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" style="margin-left: 15px;">
                    <label for="referred_id">Приглашенный:</label>
                    <select name="referred_id" id="referred_id" class="form-control" style="width: 250px;">
                        <option value="">Все</option>
                        @foreach($users as $user)
                            <option value="{{$user->id}}" @if(request('referred_id') == $user->id) selected @endif>
                                {{$user->name}} ({{$user->email}})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" style="margin-left: 15px;">
                    <label for="date_from">Дата с:</label>
                    <input type="date" name="date_from" id="date_from" class="form-control" value="{{request('date_from')}}">
                </div>
                <div class="form-group" style="margin-left: 15px;">
                    <label for="date_to">Дата по:</label>
                    <input type="date" name="date_to" id="date_to" class="form-control" value="{{request('date_to')}}">
                </div>
                <div class="form-group" style="margin-left: 15px;">
                    <button type="submit" class="btn btn-primary">Применить</button>
                    <a href="{{ route('admin.referrals.index') }}" class="btn btn-default">Сбросить</a>
                </div>
            </form>
        </div>
    </div>

    <br>

    <table id="rowtbl" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>id</th>
            <th>Приглашенный пользователь</th>
            <th>Реферер</th>
            <th>Реферальный код</th>
            <th>Дата регистрации</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($referrals as $referral)
            <tr>
                <td>{{ $referral->id }}</td>
                <td>{{ $referral->name }} ({{ $referral->email }})</td>
                <td>{{ $referral->referredBy->name ?? '-' }} ({{ $referral->referredBy->email ?? '-' }})</td>
                <td><code>{{ $referral->referredBy->referral_code ?? '-' }}</code></td>
                <td>{{ $referral->created_at->format('d.m.Y H:i') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

