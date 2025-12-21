@php
    $currentPath = request()->path();
    $isActive = function($path) use ($currentPath) {
        if ($path === '/') {
            // Для главной страницы проверяем, что путь пустой
            return $currentPath === '';
        }
        $pathWithoutSlash = ltrim($path, '/');
        // Проверяем точное совпадение или что текущий путь начинается с пути ссылки
        return $currentPath === $pathWithoutSlash || str_starts_with($currentPath, $pathWithoutSlash . '/');
    };
@endphp

<nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="/" class="flex-shrink-0 flex items-center">
                    <span class="text-3xl font-['Pacifico'] text-primary">logo</span>
                </a>
                <div class="hidden sm:ml-10 sm:flex sm:space-x-8">
                    <a href="/" class="{{ $isActive('/') ? 'border-primary text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Главная</a>
                    <a href="/ratings" class="{{ $isActive('/ratings') ? 'border-primary text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Клубный рейтинг</a>
                    <a href="/tournaments" class="{{ $isActive('/tournaments') ? 'border-primary text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Турниры</a>
                    <a href="/teams" class="{{ $isActive('/teams') ? 'border-primary text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Команды</a>
                    <a href="/players" class="{{ $isActive('/players') ? 'border-primary text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Игроки</a>
                    <a href="/upcoming-games" class="{{ $isActive('/upcoming-games') ? 'border-primary text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Ближайшие матчи</a>
                    <a href="/rules" class="{{ $isActive('/rules') ? 'border-primary text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Правила</a>
                    <a href="/blog" class="{{ $isActive('/blog') ? 'border-primary text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Новости</a>
                </div>
            </div>


            @auth
                <div class="flex items-center space-x-3">
                    <div class="relative group">
                        <a href="{{ route('account') }}" class="flex items-center space-x-3 hover:opacity-80 transition-opacity cursor-pointer">
                            <div class="w-10 h-10 rounded-full overflow-hidden bg-gray-300 flex items-center justify-center">
                                @if(auth()->user()->email)
                                    <span class="text-gray-600 font-semibold text-sm">{{ strtoupper(substr(auth()->user()->email, 0, 1)) }}</span>
                                @else
                                    <img src="/v1/images/demo/photo.jpg" alt="User Avatar" class="w-full h-full object-cover object-top">
                                @endif
                            </div>
                            <div class="hidden sm:block">
                                <div class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</div>
                            </div>
                        </a>
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1 z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                            <a href="{{ route('account') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Личный кабинет</a>
                            @if(in_array(auth()->id(), config('admins', [])))
                                <a href="{{ route('admin.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Админ-панель</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Выход</button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <div class="hidden sm:ml-6 sm:flex sm:items-center">
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 text-sm font-medium">Вход</a>
                        <a href="{{ route('register') }}" class="bg-primary hover:bg-opacity-80 text-gray-900 px-4 py-2 !rounded-button whitespace-nowrap text-sm font-medium">Регистрация</a>
                    </div>
                </div>
            @endauth



            <div class="flex items-center sm:hidden">
                <button type="button" id="mobile-menu-button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary">
                    <div class="w-6 h-6 flex items-center justify-center">
                        <i class="ri-menu-line ri-lg" id="menu-icon"></i>
                    </div>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div id="mobile-menu" class="hidden sm:hidden bg-white border-t border-gray-200">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="/" class="{{ $isActive('/') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-100' }} block px-3 py-2 rounded-md text-base font-medium">Главная</a>
            <a href="/ratings" class="{{ $isActive('/ratings') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-100' }} block px-3 py-2 rounded-md text-base font-medium">Клубный рейтинг</a>
            <a href="/tournaments" class="{{ $isActive('/tournaments') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-100' }} block px-3 py-2 rounded-md text-base font-medium">Турниры</a>
            <a href="/teams" class="{{ $isActive('/teams') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-100' }} block px-3 py-2 rounded-md text-base font-medium">Команды</a>
            <a href="/players" class="{{ $isActive('/players') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-100' }} block px-3 py-2 rounded-md text-base font-medium">Игроки</a>
            <a href="/upcoming-games" class="{{ $isActive('/upcoming-games') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-100' }} block px-3 py-2 rounded-md text-base font-medium">Ближайшие матчи</a>
            <a href="/rules" class="{{ $isActive('/rules') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-100' }} block px-3 py-2 rounded-md text-base font-medium">Правила</a>
            <a href="/blog" class="{{ $isActive('/blog') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-100' }} block px-3 py-2 rounded-md text-base font-medium">Новости</a>
            @guest
                <a href="{{ route('login') }}" class="text-gray-700 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">Вход</a>
                <a href="{{ route('register') }}" class="bg-primary hover:bg-opacity-80 text-white block px-3 py-2 rounded-md text-base font-medium text-center mt-2">Регистрация</a>
            @endguest
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIcon = document.getElementById('menu-icon');

        if (menuButton && mobileMenu) {
            menuButton.addEventListener('click', function() {
                const isHidden = mobileMenu.classList.contains('hidden');

                if (isHidden) {
                    mobileMenu.classList.remove('hidden');
                    menuIcon.classList.remove('ri-menu-line');
                    menuIcon.classList.add('ri-close-line');
                } else {
                    mobileMenu.classList.add('hidden');
                    menuIcon.classList.remove('ri-close-line');
                    menuIcon.classList.add('ri-menu-line');
                }
            });
        }
    });
</script>
