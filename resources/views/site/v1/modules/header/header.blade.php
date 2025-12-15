<nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="/" class="flex-shrink-0 flex items-center">
                    <span class="text-3xl font-['Pacifico'] text-primary">logo</span>
                </a>
                <div class="hidden sm:ml-10 sm:flex sm:space-x-8">
                    <a href="/" class="border-primary text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Главная</a>
                    <a href="/ratings" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Клубный рейтинг</a>
                    <a href="/tournaments" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Турниры</a>
                    <a href="/teams" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Команды</a>
                    <a href="/players" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Игроки</a>
                    <a href="/upcoming-games" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Ближайшие матчи</a>
                    <a href="/rules" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Правила</a>
                    <a href="/blog" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Новости</a>
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
                                <div class="text-sm text-gray-500">{{ auth()->user()->email }}</div>
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
                <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary">
                    <div class="w-6 h-6 flex items-center justify-center">
                        <i class="ri-menu-line ri-lg"></i>
                    </div>
                </button>
            </div>
        </div>
    </div>
</nav>
