@extends('admin.layouts.app')
@section('title', 'Просмотр товарищеского матча')
@section('h1', 'Просмотр товарищеского матча')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Информация о матче</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 200px;">Команда 1</th>
                            <td>{{ $item->homeTeam->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Команда 2</th>
                            <td>{{ $item->awayTeam->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Дата</th>
                            <td>{{ $item->date ? $item->date->format('d.m.Y H:i') : '-' }}</td>
                        </tr>
                        <tr>
                            <th>Счет</th>
                            <td>
                                @if($item->score_1 !== null && $item->score_2 !== null)
                                    <strong>{{ $item->score_1 }} - {{ $item->score_2 }}</strong>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Статус</th>
                            <td>
                                @if($item->status === 'played')
                                    <span class="badge badge-success">Сыгран</span>
                                @elseif($item->status === 'scheduled')
                                    <span class="badge badge-info">Запланирован</span>
                                @else
                                    <span class="badge badge-warning">Отменен</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if($item->status === 'played' && ($scorers || $assists))
        <div class="row">
            <div class="col-md-6">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Бомбардиры</h3>
                    </div>
                    <div class="box-body">
                        @if(count($scorers) > 0)
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Игрок</th>
                                    <th>Голы</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($scorers as $scorerData)
                                    <tr>
                                        <td>{{ $scorerData['user']->name ?? 'N/A' }}</td>
                                        <td>
                                            @if(is_array($scorerData['goals']))
                                                @foreach($scorerData['goals'] as $goal)
                                                    @if(isset($goal['minute']))
                                                        {{ $goal['minute'] }}'
                                                        @if(!$loop->last), @endif
                                                    @else
                                                        {{ $goal }}
                                                        @if(!$loop->last), @endif
                                                    @endif
                                                @endforeach
                                            @else
                                                {{ $scorerData['goals'] }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-muted">Нет данных о бомбардирах</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Ассистенты</h3>
                    </div>
                    <div class="box-body">
                        @if(count($assists) > 0)
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Игрок</th>
                                    <th>Передачи</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($assists as $assistData)
                                    <tr>
                                        <td>{{ $assistData['user']->name ?? 'N/A' }}</td>
                                        <td>
                                            @if(is_array($assistData['assists']))
                                                @foreach($assistData['assists'] as $assist)
                                                    @if(isset($assist['minute']))
                                                        {{ $assist['minute'] }}'
                                                        @if(!$loop->last), @endif
                                                    @else
                                                        {{ $assist }}
                                                        @if(!$loop->last), @endif
                                                    @endif
                                                @endforeach
                                            @else
                                                {{ $assistData['assists'] }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-muted">Нет данных об ассистентах</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('admin.friendly-matches.index') }}" class="btn btn-default">Назад к списку</a>
            <a href="{{ route('admin.friendly-matches.edit', $item->id) }}" class="btn btn-primary">Редактировать</a>
        </div>
    </div>

@endsection

