@php
    $currentRoute = request()->route()->getName();

    // Определяем название текущего пункта меню
    $currentPageTitle = 'Личный кабинет';

    if ($currentRoute === 'account.referrals') {
        $currentPageTitle = 'Мои рефералы';
    } elseif ($currentRoute === 'account.games' || $currentRoute === 'account.game') {
        $currentPageTitle = 'Игры';
    } elseif ($currentRoute === 'account.options') {
        $currentPageTitle = 'Настройки';
    }

    $showCurrentPage = $currentRoute !== 'account';
@endphp

<nav class="mb-6" aria-label="Хлебные крошки">
    <ol class="flex items-center space-x-2 text-sm">
        <li>
            <a href="/" class="text-gray-500 hover:text-gray-700 transition-colors">
                <div class="flex items-center">
                    <span>Главная</span>
                </div>
            </a>
        </li>
        <li>
            <i class="ri-arrow-right-s-line text-gray-400"></i>
        </li>
        <li>
            <a href="{{ route('account') }}" class="text-gray-500 hover:text-gray-700 transition-colors">
                Личный кабинет
            </a>
        </li>
        @if($showCurrentPage)
            <li>
                <i class="ri-arrow-right-s-line text-gray-400"></i>
            </li>
            <li class="text-gray-900 font-medium" aria-current="page">
                {{ $currentPageTitle }}
            </li>
        @endif
    </ol>
</nav>

