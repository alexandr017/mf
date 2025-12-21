@extends('site.v1.layouts.account')
@section ('title', 'Личный кабинет')

@section('content')
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
                            <p class="text-sm opacity-90">Сезон {{ $currentUserTeam->season->year_start }}-{{ $currentUserTeam->season->year_finish }}</p>
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
                <h2 class="heading-font text-2xl text-gray-900 mb-2">У вас нет команды</h2>
                <p class="text-gray-600 mb-4">Присоединитесь к команде, чтобы начать играть в турнирах</p>
                <a href="/teams" class="bg-primary hover:bg-opacity-80 text-gray-900 font-bold px-6 py-3 rounded-button inline-block">
                    <div class="flex items-center gap-2">
                        <i class="ri-search-line"></i>
                        <span>Найти команду</span>
                    </div>
                </a>
            </div>
        </div>
    @endif

    <!-- Header Stats -->
    <div class="mb-8">
        <h1 class="heading-font text-4xl text-gray-900 mb-6">Панель игрока</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Rating Card -->
            <div class="stat-card rounded-xl p-6 card-hover transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Общий рейтинг</p>
                        <p class="text-3xl font-bold text-primary">{{ number_format($user->rating ?? 0, 1) }}</p>
                    </div>
                    <div class="w-12 h-12 bg-primary bg-opacity-20 rounded-full flex items-center justify-center">
                        <div class="w-6 h-6 flex items-center justify-center">
                            <i class="ri-star-fill text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Goals Card -->
            <div class="stat-card rounded-xl p-6 card-hover transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Голы за карьеру</p>
                        <p class="text-3xl font-bold text-secondary">{{ $user->goals ?? 0 }}</p>
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
            <div class="stat-card rounded-xl p-6 card-hover transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Голевые передачи за карьеру</p>
                        <p class="text-3xl font-bold text-yellow-600">{{ $user->assists ?? 0 }}</p>
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
            <div class="stat-card rounded-xl p-6 card-hover transition-all duration-300">
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
                                            {{ $user->preferred_position ? \App\Models\User::getPositions()[$user->preferred_position] ?? 'Игрок' : 'Игрок' }}
                                            @if($stat['season'])
                                                • Сезон {{ $stat['season']->year_start }}-{{ $stat['season']->year_finish }}
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
                            <p>У вас пока нет истории сезонов</p>
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
                                        $years[$stat['season']->year_start] = true;
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
                            <span class="font-bold">{{ $matchesCount > 0 ? number_format(($user->goals ?? 0) / $matchesCount, 2) : '0.00' }}</span>
                        </div>
                        <div class="bg-gray-200 rounded-full h-2">
                            <div class="bg-primary h-2 rounded-full" style="width: {{ min(100, ($matchesCount > 0 ? (($user->goals ?? 0) / $matchesCount) * 100 : 0)) }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-gray-600">Передач за матч</span>
                            <span class="font-bold">{{ $matchesCount > 0 ? number_format(($user->assists ?? 0) / $matchesCount, 2) : '0.00' }}</span>
                        </div>
                        <div class="bg-gray-200 rounded-full h-2">
                            <div class="bg-secondary h-2 rounded-full" style="width: {{ min(100, ($matchesCount > 0 ? (($user->assists ?? 0) / $matchesCount) * 100 : 0)) }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Premium Account -->
            <div class="bg-gradient-to-br from-yellow-400 to-orange-500 rounded-xl shadow-lg p-6 text-white">
                <h2 class="heading-font text-xl mb-4">Премиум аккаунт</h2>
                @if($activeSubscription)
                    <div class="bg-white bg-opacity-20 rounded-lg p-4 mb-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-semibold">Активная подписка</span>
                            <span class="text-xs bg-green-500 px-2 py-1 rounded-full">Активна</span>
                        </div>
                        <p class="text-sm font-medium">{{ $activeSubscription->plan->name }}</p>
                        <p class="text-xs opacity-90 mt-1">
                            Действует до {{ $activeSubscription->ends_at->format('d.m.Y') }}
                        </p>
                        <p class="text-xs opacity-90">
                            Множитель прокачки: x{{ $activeSubscription->plan->rating_multiplier }}
                        </p>
                    </div>
                @else
                    <p class="text-sm mb-4 opacity-90">Ускорьте прокачку рейтинга в мини-играх</p>
                @endif
                
                <div class="space-y-3 mb-4">
                    @foreach($subscriptionPlans as $plan)
                        <div class="bg-white bg-opacity-20 rounded-lg p-3 {{ $activeSubscription && $activeSubscription->subscription_plan_id === $plan->id ? 'ring-2 ring-white' : '' }}">
                            <div class="flex items-center justify-between mb-1">
                                <span class="font-semibold">{{ $plan->name }}</span>
                                <span class="text-lg font-bold">${{ number_format($plan->price, 2) }}/мес</span>
                            </div>
                            <p class="text-xs opacity-90">
                                Прокачка в {{ $plan->rating_multiplier }} раза быстрее
                            </p>
                            @if($activeSubscription && $activeSubscription->subscription_plan_id === $plan->id)
                                <p class="text-xs mt-1 font-medium">Текущий план</p>
                            @endif
                        </div>
                    @endforeach
                </div>
                
                @if($activeSubscription)
                    <button class="w-full bg-white bg-opacity-20 text-white font-bold py-3 px-4 rounded-button hover:bg-opacity-30 transition-colors border-2 border-white">
                        <div class="flex items-center justify-center space-x-2">
                            <i class="ri-settings-3-line"></i>
                            <span>Управление подпиской</span>
                        </div>
                    </button>
                @else
                    <button class="w-full bg-white text-gray-900 font-bold py-3 px-4 rounded-button hover:bg-opacity-90 transition-colors">
                        <div class="flex items-center justify-center space-x-2">
                            <i class="ri-vip-crown-line"></i>
                            <span>Купить премиум</span>
                        </div>
                    </button>
                @endif
            </div>
        </div>
    </div>

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
    });
</script>

@endsection
