@extends('site.v1.layouts.default')
@section ('title', $player->name . ' - Профиль игрока')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Current Team Banner -->
    @if($currentUserTeam && $currentUserTeam->team)
        <div class="mb-8 bg-gradient-to-r from-primary to-secondary rounded-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    @if($currentUserTeam->team->logo)
                        <div class="w-16 h-16 rounded-full overflow-hidden bg-white p-1">
                            <img src="{{ asset('storage/' . $currentUserTeam->team->logo) }}" alt="{{ $currentUserTeam->team->name }}" class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="w-16 h-16 rounded-full bg-white bg-opacity-20 flex items-center justify-center">
                            <i class="ri-team-line text-3xl"></i>
                        </div>
                    @endif
                    <div>
                        <h2 class="heading-font text-2xl mb-1">Текущая команда</h2>
                        <p class="text-lg font-semibold">{{ $currentUserTeam->team->name }}</p>
                        @if($currentUserTeam->season)
                            <p class="text-sm opacity-90">Сезон {{ $currentUserTeam->season }}</p>
                        @endif
                    </div>
                </div>
                <a href="/teams/{{ $currentUserTeam->team->alias ?? $currentUserTeam->team->id }}" class="bg-white text-gray-900 font-bold px-6 py-3 rounded-button hover:bg-opacity-90 transition-colors inline-block">
                    <div class="flex items-center gap-2">
                        <i class="ri-arrow-right-line"></i>
                        <span>Перейти к команде</span>
                    </div>
                </a>
            </div>
        </div>
    @else
        <div class="mb-8 bg-gray-100 rounded-xl p-6 border-2 border-dashed border-gray-300">
            <div class="text-center">
                <div class="w-16 h-16 mx-auto mb-4 bg-gray-200 rounded-full flex items-center justify-center">
                    <i class="ri-team-line text-3xl text-gray-400"></i>
                </div>
                <h2 class="heading-font text-2xl text-gray-900 mb-2">Игрок не привязан к команде</h2>
                <p class="text-gray-600">В данный момент игрок не состоит ни в одной команде</p>
            </div>
        </div>
    @endif

    <!-- Header Stats -->
    <div class="mb-8">
        <div class="flex items-center gap-6 mb-6">
            <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-primary bg-gray-200 flex items-center justify-center flex-shrink-0">
                @if($player->avatar)
                    <img src="{{ asset('storage/' . $player->avatar) }}" alt="{{ $player->name }}" class="w-full h-full object-cover">
                @else
                    <span class="text-4xl font-bold text-gray-400">{{ strtoupper(substr($player->name ?? 'U', 0, 1)) }}</span>
                @endif
            </div>
            <div>
                <h1 class="heading-font text-4xl text-gray-900 mb-2">{{ $player->name ?? 'Игрок' }}</h1>
                @if($player->nickname)
                    <p class="text-lg text-gray-600">@{{ $player->nickname }}</p>
                @endif
                <div class="flex items-center gap-4 mt-2">
                    @if($player->show_hometown && $player->hometownCity)
                        <div class="flex items-center gap-2 text-gray-600">
                            <i class="ri-map-pin-line"></i>
                            <span class="text-sm">{{ $player->hometownCity->name }}</span>
                        </div>
                    @endif
                    @if($currentTeam)
                        <div class="flex items-center gap-2 text-gray-600">
                            <i class="ri-team-line"></i>
                            <span class="text-sm">В настоящее время играет за <strong>{{ $currentTeam->city ? $currentTeam->city->name : ($currentTeam->name ?? 'команду') }}</strong></span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Rating Card -->
            <div class="bg-white rounded-xl shadow-lg p-6 border-2 border-gray-100 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Общий рейтинг</p>
                        <p class="text-3xl font-bold text-primary">{{ number_format($player->rating ?? 0, 1) }}</p>
                    </div>
                    <div class="w-12 h-12 bg-primary bg-opacity-20 rounded-full flex items-center justify-center">
                        <div class="w-6 h-6 flex items-center justify-center">
                            <i class="ri-star-fill text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Goals Card -->
            <div class="bg-white rounded-xl shadow-lg p-6 border-2 border-gray-100 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Голы за карьеру</p>
                        <p class="text-3xl font-bold text-secondary">{{ $player->goals ?? 0 }}</p>
                        <p class="text-sm text-green-600">+0 за сезон</p>
                    </div>
                    <div class="w-12 h-12 bg-secondary bg-opacity-20 rounded-full flex items-center justify-center">
                        <div class="w-6 h-6 flex items-center justify-center">
                            <i class="ri-football-fill text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Assists Card -->
            <div class="bg-white rounded-xl shadow-lg p-6 border-2 border-gray-100 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Голевые передачи за карьеру</p>
                        <p class="text-3xl font-bold text-yellow-600">{{ $player->assists ?? 0 }}</p>
                        <p class="text-sm text-green-600">+0 за сезон</p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                        <div class="w-6 h-6 flex items-center justify-center">
                            <i class="ri-hand-heart-fill text-yellow-600"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Matches Card -->
            <div class="bg-white rounded-xl shadow-lg p-6 border-2 border-gray-100 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Сыграно матчей</p>
                        <p class="text-3xl font-bold text-blue-600">{{ $matchesCount ?? 0 }}</p>
                        <p class="text-sm text-green-600">+0 за сезон</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <div class="w-6 h-6 flex items-center justify-center">
                            <i class="ri-timer-fill text-blue-600"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Career History -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Career by Season -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="heading-font text-2xl text-gray-900 mb-6">Карьера по сезонам</h2>

                <div class="space-y-6">
                    @forelse($seasonStats as $stat)
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-4">
                                    @if($stat['team'] && $stat['team']->logo)
                                        <div class="w-12 h-12 rounded-full overflow-hidden">
                                            <img src="{{ asset('storage/' . $stat['team']->logo) }}" alt="{{ $stat['team']->name }}" class="w-full h-full object-cover">
                                        </div>
                                    @else
                                        <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center">
                                            <i class="ri-team-line text-gray-400"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <h3 class="font-bold text-gray-900">{{ $stat['team']->name ?? 'Команда не найдена' }}</h3>
                                        <p class="text-sm text-gray-500">
                                            {{ $player->preferred_position ? \App\Models\User::getPositions()[$player->preferred_position] ?? 'Игрок' : 'Игрок' }}
                                            @if($stat['season'])
                                                • Сезон {{ $stat['season'] }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                @if($stat['is_current'])
                                    <div class="text-sm font-medium text-primary">Текущая команда</div>
                                @endif
                            </div>
                            <div class="grid grid-cols-3 gap-4">
                                <div class="text-center">
                                    <p class="text-2xl font-bold text-primary">{{ $stat['goals'] }}</p>
                                    <p class="text-sm text-gray-500">Голов</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-2xl font-bold text-secondary">{{ $stat['assists'] }}</p>
                                    <p class="text-sm text-gray-500">Передач</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-2xl font-bold text-blue-600">{{ $stat['matches'] }}</p>
                                    <p class="text-sm text-gray-500">Матчей</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 text-gray-500">
                            <i class="ri-inbox-line text-4xl mb-2"></i>
                            <p>У игрока пока нет истории сезонов</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Personal Statistics by Year -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="heading-font text-2xl text-gray-900 mb-6">Персональная статистика по годам</h2>
                
                <!-- Tabs -->
                <div class="border-b border-gray-200 mb-6">
                    <div class="flex space-x-4">
                        <button class="px-4 py-2 border-b-2 border-primary text-primary font-medium tab-button active" data-tab="stats">Статистика</button>
                        <button class="px-4 py-2 border-b-2 border-transparent text-gray-600 hover:text-gray-900 font-medium tab-button" data-tab="friendly">Товарищеские игры</button>
                        <button class="px-4 py-2 border-b-2 border-transparent text-gray-600 hover:text-gray-900 font-medium tab-button" data-tab="titles">Титулы</button>
                    </div>
                </div>

                <!-- Stats Tab -->
                <div id="stats-tab" class="tab-content">
                    <div class="space-y-4">
                        @php
                            $years = [];
                            if (!empty($seasonStats)) {
                                foreach ($seasonStats as $stat) {
                                    if ($stat['season']) {
                                        $years[$stat['season']] = true;
                                    }
                                }
                            }
                            $years = array_keys($years);
                            rsort($years);
                        @endphp
                        @forelse($years as $year)
                            <div class="border border-gray-200 rounded-lg p-4">
                                <h3 class="font-bold text-gray-900 mb-3">{{ $year }} год</h3>
                                <div class="grid grid-cols-3 gap-4">
                                    <div class="text-center">
                                        <p class="text-xl font-bold text-primary">0</p>
                                        <p class="text-sm text-gray-500">Голов</p>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-xl font-bold text-secondary">0</p>
                                        <p class="text-sm text-gray-500">Передач</p>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-xl font-bold text-blue-600">0</p>
                                        <p class="text-sm text-gray-500">Матчей</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-gray-500">
                                <p>Статистика по годам пока недоступна</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Friendly Matches Tab -->
                <div id="friendly-tab" class="tab-content hidden">
                    <div class="space-y-4">
                        @php
                            $friendlyYears = [];
                            if (isset($yearlyStats) && !empty($yearlyStats)) {
                                $friendlyYears = array_keys($yearlyStats);
                                rsort($friendlyYears);
                            }
                        @endphp
                        @forelse($friendlyYears as $year)
                            @php
                                $yearGoals = $yearlyStats[$year]['goals'] ?? 0;
                                $yearAssists = $yearlyStats[$year]['assists'] ?? 0;
                                $yearMatches = $yearlyStats[$year]['matches'] ?? 0;
                            @endphp
                            <div class="border border-gray-200 rounded-lg p-4">
                                <h3 class="font-bold text-gray-900 mb-3">{{ $year }} год</h3>
                                <div class="grid grid-cols-3 gap-4">
                                    <div class="text-center">
                                        <p class="text-xl font-bold text-primary">{{ $yearGoals }}</p>
                                        <p class="text-sm text-gray-500">Голов</p>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-xl font-bold text-secondary">{{ $yearAssists }}</p>
                                        <p class="text-sm text-gray-500">Передач</p>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-xl font-bold text-blue-600">{{ $yearMatches }}</p>
                                        <p class="text-sm text-gray-500">Матчей</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-gray-500">
                                <p>Статистика товарищеских игр по годам пока недоступна</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Titles Tab -->
                <div id="titles-tab" class="tab-content hidden">
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @forelse($titlesByYear as $title)
                            <div class="border border-gray-200 rounded-lg p-4 text-center">
                                @if($title['tournament'] && $title['tournament']->image)
                                    <img src="{{ asset('storage/' . $title['tournament']->image) }}" alt="{{ $title['tournament']->name }}" class="w-16 h-16 mx-auto mb-2 object-cover">
                                @else
                                    <div class="w-16 h-16 mx-auto mb-2 bg-gray-200 rounded-full flex items-center justify-center">
                                        <i class="ri-trophy-line text-2xl text-gray-400"></i>
                                    </div>
                                @endif
                                <p class="text-sm font-medium text-gray-900">{{ $title['tournament']->name ?? 'Турнир' }}</p>
                                <p class="text-xs text-gray-500">{{ $title['year'] ?? '' }}</p>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-8 text-gray-500">
                                <i class="ri-trophy-line text-4xl mb-2"></i>
                                <p>Титулы пока не завоеваны</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="space-y-6">
            <!-- Achievements -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="heading-font text-xl text-gray-900 mb-4">Достижения</h2>
                <div class="space-y-4">
                    @forelse($achievements as $achievement)
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-primary bg-opacity-20 rounded-full flex items-center justify-center flex-shrink-0">
                                @if($achievement->image)
                                    <img src="{{ asset('storage/' . $achievement->image) }}" alt="{{ $achievement->name }}" class="w-full h-full rounded-full object-cover">
                                @else
                                    <i class="ri-trophy-fill text-primary"></i>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">{{ $achievement->name }}</p>
                                <p class="text-xs text-gray-500">
                                    @if($achievement->pivot->earned_at)
                                        Получено {{ $achievement->pivot->earned_at->format('d.m.Y') }}
                                    @else
                                        Получено
                                    @endif
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4 text-gray-500">
                            <i class="ri-inbox-line text-2xl mb-2"></i>
                            <p class="text-sm">Достижений пока нет</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Performance Trends -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="heading-font text-xl text-gray-900 mb-4">Динамика показателей</h2>
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-gray-600">Голов за матч</span>
                            <span class="font-bold">{{ $matchesCount > 0 ? number_format(($player->goals ?? 0) / $matchesCount, 2) : '0.00' }}</span>
                        </div>
                        <div class="bg-gray-200 rounded-full h-2">
                            <div class="bg-primary h-2 rounded-full" style="width: {{ min(100, ($matchesCount > 0 ? (($player->goals ?? 0) / $matchesCount) * 100 : 0)) }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-gray-600">Передач за матч</span>
                            <span class="font-bold">{{ $matchesCount > 0 ? number_format(($player->assists ?? 0) / $matchesCount, 2) : '0.00' }}</span>
                        </div>
                        <div class="bg-gray-200 rounded-full h-2">
                            <div class="bg-secondary h-2 rounded-full" style="width: {{ min(100, ($matchesCount > 0 ? (($player->assists ?? 0) / $matchesCount) * 100 : 0)) }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Report Button (только если это не свой профиль) -->
            @if(!$isOwnProfile)
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <button id="report-player-btn" class="w-full text-gray-600 hover:text-gray-900 font-medium py-2 px-4 rounded-button border border-gray-300 hover:border-gray-400 transition-colors text-sm">
                        <div class="flex items-center justify-center space-x-2">
                            <i class="ri-flag-line"></i>
                            <span>Подать жалобу</span>
                        </div>
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Report Modal -->
@if(!$isOwnProfile)
    <div id="report-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center z-50 p-4">
        <div class="bg-white rounded-xl p-6 max-w-md w-full">
            <div class="flex items-center justify-between mb-4">
                <h3 class="heading-font text-xl text-gray-900">Подать жалобу на игрока</h3>
                <button id="close-report-modal" class="text-gray-400 hover:text-gray-600">
                    <i class="ri-close-line text-2xl"></i>
                </button>
            </div>
            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded-lg text-sm">
                    {{ session('success') }}
                </div>
            @endif
            @if($errors->any())
                <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded-lg text-sm">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form id="report-form" method="POST" action="{{ route('reports.store') }}">
                @csrf
                <input type="hidden" name="reported_user_id" value="{{ $player->id }}">
                @if(!auth()->check())
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Ваш email *</label>
                        <input type="email" name="reporter_email" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="your@email.com">
                        <p class="text-xs text-gray-500 mt-1">Нужен для связи по жалобе</p>
                    </div>
                @endif
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Категория нарушения *</label>
                    <select name="category_id" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                        <option value="">Выберите категорию...</option>
                        @foreach(\App\Models\Reports\ReportCategory::getAll() as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Дополнительные детали (необязательно)</label>
                    <textarea name="description" rows="3" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="Опишите ситуацию подробнее..."></textarea>
                </div>
                <div class="flex gap-3">
                    <button type="button" id="cancel-report" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2 px-4 rounded-button transition-colors">
                        Отмена
                    </button>
                    <button type="submit" class="flex-1 bg-primary hover:bg-opacity-80 text-gray-900 font-bold py-2 px-4 rounded-button transition-colors">
                        Отправить жалобу
                    </button>
                </div>
            </form>
        </div>
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tab switching
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-content');
        
        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                const targetTab = this.getAttribute('data-tab');
                
                // Remove active class from all buttons
                tabButtons.forEach(btn => {
                    btn.classList.remove('active', 'border-primary', 'text-primary');
                    btn.classList.add('border-transparent', 'text-gray-600');
                });
                
                // Hide all tab contents
                tabContents.forEach(content => {
                    content.classList.add('hidden');
                });
                
                // Show selected tab
                this.classList.add('active', 'border-primary', 'text-primary');
                this.classList.remove('border-transparent', 'text-gray-600');
                document.getElementById(targetTab + '-tab').classList.remove('hidden');
            });
        });

        // Report Modal
        @if(!$isOwnProfile)
        const reportBtn = document.getElementById('report-player-btn');
        const reportModal = document.getElementById('report-modal');
        const closeReportModal = document.getElementById('close-report-modal');
        const cancelReport = document.getElementById('cancel-report');
        
        if (reportBtn && reportModal) {
            reportBtn.addEventListener('click', function() {
                reportModal.classList.remove('hidden');
                reportModal.classList.add('flex');
            });
            
            function closeModal() {
                reportModal.classList.add('hidden');
                reportModal.classList.remove('flex');
            }
            
            if (closeReportModal) {
                closeReportModal.addEventListener('click', closeModal);
            }
            
            if (cancelReport) {
                cancelReport.addEventListener('click', closeModal);
            }
            
            reportModal.addEventListener('click', function(e) {
                if (e.target === reportModal) {
                    closeModal();
                }
            });
        }
        @endif
    });
</script>

@endsection
