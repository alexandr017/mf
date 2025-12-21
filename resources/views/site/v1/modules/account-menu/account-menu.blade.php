@php
    $user = auth()->user();
    $currentRoute = request()->route()->getName();

    // Получаем последнюю команду игрока
    $currentTeam = null;
    if ($user) {
        $latestUserTeam = $user->userTeams()
            ->with('team')
            ->latest('created_at')
            ->first();
        $currentTeam = $latestUserTeam ? $latestUserTeam->team : null;
    }

    // Определяем активный пункт меню
    $isActive = function($route) use ($currentRoute) {
        if ($route === 'account' && $currentRoute === 'account') {
            return true;
        }
        if ($route === 'account.referrals' && $currentRoute === 'account.referrals') {
            return true;
        }
        if ($route === 'account.options' && $currentRoute === 'account.options') {
            return true;
        }
        if ($route === 'account.games' && ($currentRoute === 'account.games' || $currentRoute === 'account.game')) {
            return true;
        }
        return false;
    };
@endphp

<div class="h-full overflow-y-auto">
    <!-- Close Button for Mobile -->
    <div class="md:hidden flex justify-end p-4 border-b">
        <button id="close-sidebar-button" class="text-gray-600 hover:text-gray-900">
            <i class="ri-close-line text-2xl"></i>
        </button>
    </div>
    
    <div class="p-6">
        <div class="text-center mb-8">
            <div class="w-20 h-20 mx-auto rounded-full overflow-hidden mb-4 border-4 border-primary bg-gray-300 flex items-center justify-center">
                @if($user && $user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="w-full h-full object-cover object-top">
                @elseif($user && $user->name)
                    <span class="text-3xl font-bold text-gray-600">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                @else
                    <i class="ri-user-line text-4xl text-gray-400"></i>
                @endif
            </div>
            <h2 class="font-bold text-gray-900">{{ $user->name ?? 'Игрок' }}</h2>
            @if($user && $user->nickname)
                <p class="text-sm text-gray-500">@{{ $user->nickname }}</p>
            @endif
            @if($user && $user->rating)
                <p class="text-sm text-gray-500 mt-1">Рейтинг: {{ number_format($user->rating, 1) }}</p>
            @endif
        </div>

        <nav class="space-y-1">
            <a href="{{ route('account') }}" class="{{ $isActive('account') ? 'sidebar-active' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }} flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors">
                <div class="w-5 h-5 mr-3 flex items-center justify-center">
                    <i class="ri-dashboard-line"></i>
                </div>
                Личный кабинет
            </a>
            @if($currentTeam)
                <a href="/teams/{{ $currentTeam->alias ?? $currentTeam->id }}" class="text-gray-600 hover:text-gray-900 hover:bg-gray-100 flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors">
                    <div class="w-5 h-5 mr-3 flex items-center justify-center">
                        <i class="ri-team-line"></i>
                    </div>
                    Моя команда
                </a>
            @else
                <span class="text-gray-400 flex items-center px-4 py-3 text-sm font-medium rounded-lg cursor-not-allowed">
                    <div class="w-5 h-5 mr-3 flex items-center justify-center">
                        <i class="ri-team-line"></i>
                    </div>
                    Моя команда
                </span>
            @endif
            <a href="{{ route('account.games') }}" class="{{ $isActive('account.games') ? 'sidebar-active' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }} flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors">
                <div class="w-5 h-5 mr-3 flex items-center justify-center">
                    <i class="ri-football-line"></i>
                </div>
                Игры
            </a>
            <a href="{{ route('account.referrals') }}" class="{{ $isActive('account.referrals') ? 'sidebar-active' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }} flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors">
                <div class="w-5 h-5 mr-3 flex items-center justify-center">
                    <i class="ri-share-line"></i>
                </div>
                Мои рефералы
            </a>
            <a href="{{ route('account.options') }}" class="{{ $isActive('account.options') ? 'sidebar-active' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }} flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors">
                <div class="w-5 h-5 mr-3 flex items-center justify-center">
                    <i class="ri-settings-3-line"></i>
                </div>
                Настройки
            </a>
        </nav>

        @if($user && $user->rating)
        <div class="mt-8 p-4 bg-primary bg-opacity-10 rounded-lg">
            <div class="flex items-center">
                <div class="w-8 h-8 mr-3 flex items-center justify-center">
                    <i class="ri-trophy-line text-primary ri-lg"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-900">Текущий рейтинг</p>
                    <p class="text-lg font-bold text-primary">{{ number_format($user->rating, 1) }}</p>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
