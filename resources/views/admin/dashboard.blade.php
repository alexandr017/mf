@extends('admin.layouts.app')
@section('title','Добро пожаловать')
@section('h1','Добро пожаловать')

@section('content')
    <!-- Status Alert -->
    @if($status !== 'ok')
        <div class="alert alert-{{ $status === 'warning' ? 'warning' : 'info' }} alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-{{ $status === 'warning' ? 'warning' : 'info' }}"></i> Внимание!</h4>
            {{ $statusMessage }}
        </div>
    @endif

    <!-- Statistics Cards -->
    <div class="row">
        <!-- Total Users -->
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ number_format($totalUsers, 0, ',', ' ') }}</h3>
                    <p>Всего пользователей</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
            </div>
        </div>

        <!-- Total Teams -->
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ number_format($totalTeams, 0, ',', ' ') }}</h3>
                    <p>Всего команд</p>
                </div>
                <div class="icon">
                    <i class="fa fa-group"></i>
                </div>
            </div>
        </div>

        <!-- Users with Teams -->
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ number_format($usersWithTeams, 0, ',', ' ') }}</h3>
                    <p>Пользователей в командах</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user-plus"></i>
                </div>
            </div>
        </div>

        <!-- Active Users -->
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{ number_format($activeUsers, 0, ',', ' ') }}</h3>
                    <p>Активных пользователей<br>(2-3 недели)</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user-circle"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Team Capacity Statistics -->
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Общее соотношение команд и игроков</h3>
                </div>
                <div class="box-body">
                    <div class="info-box">
                        <span class="info-box-icon bg-blue"><i class="fa fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Игроков в командах</span>
                            <span class="info-box-number">{{ number_format($usersWithTeams, 0, ',', ' ') }}</span>
                        </div>
                    </div>
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="fa fa-building"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Общая вместимость</span>
                            <span class="info-box-number">{{ number_format($totalCapacity, 0, ',', ' ') }} мест</span>
                        </div>
                    </div>
                    <div class="progress-group">
                        <span class="progress-text">Заполненность</span>
                        <span class="progress-number"><b>{{ number_format($usersWithTeams, 0, ',', ' ') }}</b>/{{ number_format($totalCapacity, 0, ',', ' ') }}</span>
                        <div class="progress sm">
                            <div class="progress-bar progress-bar-{{ $totalRatio > 70 ? 'red' : ($totalRatio > 50 ? 'yellow' : 'green') }}" style="width: {{ min($totalRatio, 100) }}%"></div>
                        </div>
                        <small>{{ number_format($totalRatio, 2) }}% заполнено</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Соотношение для активных игроков</h3>
                    <div class="box-tools pull-right">
                        <span class="label label-info">Последние 2-3 недели</span>
                    </div>
                </div>
                <div class="box-body">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="fa fa-user-circle"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Активных игроков в командах</span>
                            <span class="info-box-number">{{ number_format($activeUsersWithTeams, 0, ',', ' ') }}</span>
                        </div>
                    </div>
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="fa fa-building"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Общая вместимость</span>
                            <span class="info-box-number">{{ number_format($activeCapacity, 0, ',', ' ') }} мест</span>
                        </div>
                    </div>
                    <div class="progress-group">
                        <span class="progress-text">Заполненность (активные)</span>
                        <span class="progress-number"><b>{{ number_format($activeUsersWithTeams, 0, ',', ' ') }}</b>/{{ number_format($activeCapacity, 0, ',', ' ') }}</span>
                        <div class="progress sm">
                            <div class="progress-bar progress-bar-{{ $activeRatio > 70 ? 'red' : ($activeRatio > 50 ? 'yellow' : 'green') }}" style="width: {{ min($activeRatio, 100) }}%"></div>
                        </div>
                        <small>{{ number_format($activeRatio, 2) }}% заполнено</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recommendations -->
    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Рекомендации</h3>
                </div>
                <div class="box-body">
                    @if($totalRatio > 90)
                        <div class="alert alert-danger">
                            <strong>Критическая ситуация!</strong> Заполненность команд превышает 90%. Необходимо создать новые команды или увеличить лимит игроков.
                        </div>
                    @elseif($totalRatio > 70)
                        <div class="alert alert-warning">
                            <strong>Внимание!</strong> Заполненность команд превышает 70%. Рекомендуется создать дополнительные команды.
                        </div>
                    @elseif($totalRatio < 20)
                        <div class="alert alert-info">
                            <strong>Информация:</strong> Заполненность команд менее 20%. Есть избыток свободных мест.
                        </div>
                    @else
                        <div class="alert alert-success">
                            <strong>Отлично!</strong> Соотношение команд и игроков находится в норме.
                        </div>
                    @endif

                    @if($activeRatio > 70)
                        <div class="alert alert-warning">
                            <strong>Внимание!</strong> Среди активных игроков заполненность превышает 70%.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Dynamics Chart -->
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Динамика за последние 30 дней</h3>
                </div>
                <div class="box-body">
                    <canvas id="dynamicsChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('dynamicsChart');
            if (ctx) {
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: @json($daysAgo),
                        datasets: [{
                            label: 'Пользователи',
                            data: @json($usersData),
                            borderColor: 'rgb(75, 192, 192)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            tension: 0.1
                        }, {
                            label: 'Команды',
                            data: @json($teamsData),
                            borderColor: 'rgb(255, 99, 132)',
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            tension: 0.1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        });
    </script>
@endsection
